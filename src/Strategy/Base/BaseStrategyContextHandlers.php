<?php

namespace Untek\Core\Pattern\Strategy\Base;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Contract\Common\Exceptions\InvalidArgumentException;
use Untek\Core\Instance\Helpers\InstanceHelper;

/**
 * Class BaseStrategyContext
 *
 * @package Untek\Core\Base\Scenario\Base
 *
 * @property-read Object $strategyInstance
 * @property-read array $strategyDefinitions
 * @property-write string $strategyName
 */
abstract class BaseStrategyContextHandlers extends BaseStrategyContext
{

    private $strategyDefinitions = [];

    public function getStrategyDefinitions()
    {
        return $this->strategyDefinitions;
    }

    public function setStrategyDefinitions(array $handlers)
    {
        $this->strategyDefinitions = $handlers;
    }

    public function forgeStrategyInstanceByName(string $strategyName)
    {
        $this->validate($strategyName);
        $strategyDefinition = ArrayHelper::getValue($this->getStrategyDefinitions(), $strategyName);
        return $this->forgeStrategyInstance($strategyDefinition);
    }

    public function forgeStrategyInstance($strategyDefinition)
    {
        $strategyInstance = InstanceHelper::create($strategyDefinition, []);
        return $strategyInstance;
    }

    public function setStrategyName(string $strategyName)
    {
        $this->validate($strategyName);
        $strategyDefinition = ArrayHelper::getValue($this->getStrategyDefinitions(), $strategyName);
        $this->setStrategyDefinition($strategyDefinition);
    }

    public function setStrategyDefinition($strategyDefinition)
    {
        $strategyInstance = $this->forgeStrategyInstance($strategyDefinition);
        $this->setStrategyInstance($strategyInstance);
    }

    protected function validate($name)
    {
        $strategyHandlers = $this->getStrategyDefinitions();
        if (empty($strategyHandlers)) {
            throw new InvalidArgumentException('Strategy handlers not defined!');
        }
        if (!isset($strategyHandlers[$name])) {
            throw new InvalidArgumentException('Handler "' . $name . '" not found!');
        }
    }

}
