<?php
/**
 * @package    Fuel\Dependency
 * @version    2.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Dependency;

use SplStack;
use Countable;

/**
 *
 */
class Stack implements Countable
{
	/**
	 * @var
	 */
	protected $stack;

	/**
	 * @var
	 */
	protected $container;

	/**
	 * Constructor
	 *
	 * @param   Fuel\Depedency\Container  $container   container
	 */
	public function __construct(Container $container)
	{
		$this->stack = new SplStack;
		$this->container = $container;
	}

	/**
	 * Create a new instance and pushes it on the stack.
	 *
	 * @param   array  $arguments  constructor arguments
	 * @return  object  resolved dependency
	 */
	public function push($instance)
	{
		$this->stack->push($instance);

		return $instance;
	}

	/**
	 * Pop a instance off the stack and return it
	 *
	 * @return  object  instance
	 */
	public function pop()
	{
		if ( ! $this->stack->isEmpty())
		{
			return $this->stack->pop();
		}
	}

	/**
	 * Get the currect/top instance off the stack
	 *
	 * @return  object  instance
	 */
	public function top()
	{
		if ( ! $this->stack->isEmpty())
		{
			return $this->stack->top();
		}
	}

	/**
	 * Get the first/bottom instance off the stack
	 *
	 * @return  object  instance
	 */
	public function bottom()
	{
		if ( ! $this->stack->isEmpty())
		{
			return $this->stack->bottom();
		}
	}

	/**
	 * Get the number of instances on the stack
	 *
	 * @return  int  count
	 */
	public function count()
	{
		return count($this->stack);
	}

	/**
	 * Pass all other calls directly on to the stack
	 *
	 * @return mixed
	 */
	public function __call($name, $args)
	{
		return call_user_func_array(array($this->stack, $name), $args);
	}
}
