<?php
declare(strict_types=1);

/*
 * This file is part of PhuninNode.
 *
 ** (c) 2013 - 2016 Cees-Jan Kiewiet
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WyriHaximus\PhuninNode;

class CommandsCollection
{
    /**
     * @var array
     */
    protected $commands;

    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }

    public function setNode(Node $node)
    {
        foreach ($this->commands as $command) {
            $command->setNode($node);
        }
    }

    public function has($command)
    {
        return isset($this->commands[$command]);
    }

    public function get($command)
    {
        if (!$this->has($command)) {
            throw new \Exception();
        }

        return $this->commands[$command];
    }

    public function keys()
    {
        return array_keys($this->commands);
    }
}
