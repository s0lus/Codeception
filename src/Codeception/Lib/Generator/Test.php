<?php

declare(strict_types=1);

namespace Codeception\Lib\Generator;

use Codeception\Configuration;
use Codeception\Lib\Generator\Shared\Classname;
use Codeception\Util\Shared\Namespaces;
use Codeception\Util\Template;

class Test
{
    use Namespaces;
    use Classname;

    /**
     * @var string
     */
    protected $template = <<<EOF
<?php

{{namespace}}

class {{name}}Test extends \Codeception\Test\Unit
{
{{tester}}
    protected function _before()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }
}
EOF;

    /**
     * @var string
     */
    protected $testerLegacyTemplate = <<<EOF

    /** @var {{actorClass}}  */
    protected \${{actor}};
    
EOF;

    /**
     * @var string
     */
    protected $testerTemplate = <<<EOF

    protected {{actorClass}} \${{actor}};

EOF;

    /**
     * @var array
     */
    protected $settings = [];

    /**
     * @var string
     */
    protected $name;

    public function __construct(array $settings, string $name)
    {
        $this->settings = $settings;
        $this->name = $this->removeSuffix($name, 'Test');
    }

    public function produce(): string
    {
        $actor = $this->settings['actor'];

        $ns = $this->getNamespaceHeader($this->settings['namespace'] . '\\' . ucfirst($this->settings['suite']) . '\\' . $this->name);

        if ($ns) {
            $ns .= "\nuse ". $this->supportNamespace() . $actor.";";
        }


        $testerTemplate = (PHP_MAJOR_VERSION == 7) && (PHP_MINOR_VERSION < 4) ? $this->testerLegacyTemplate : $this->testerTemplate;

        $tester = '';
        if ($this->settings['actor']) {
            $tester = (new Template($testerTemplate))
            ->place('actorClass', $actor)
            ->place('actor', lcfirst(Configuration::config()['actor_suffix']))
            ->produce();
        }

        return (new Template($this->template))
            ->place('namespace', $ns)
            ->place('name', $this->getShortClassName($this->name))
            ->place('tester', $tester)
            ->produce();
    }
}
