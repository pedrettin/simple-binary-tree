<?php

/**
* Node of the tree
*/
class Node {

	public $left;
	public $right;
	public $value;

	public function __construct ($value, $left = null, $right = null) {
		$this->value = $value;
		$this->left = $left;
		$this->right = $right;
	}

}

/**
* Unbalanced binary tree
*/
class BinaryTree {

	private $root = null;
	private $numNodes = 0;

	/**
	* Pushes the passed in value in the correct place in the tree
	* @param string|int $value
	*/
	public function push ($value) {
		if (!$this->root) {
			$this->root = new Node($value);
			$this->numNodes++;
		}
		else {
			$this->pushToNode($value, $this->root);
		}
	}

	/**
	* Pushes the passed in value in the correct place in the tree givent the node
	* to start from
	* @param string|int $value
	* @param Node $node
	*/
	private function pushToNode ($value, $node) {
		if ($value > $node->value && $node->right) {
			$this->pushToNode($value, $node->right);
		} else if ($value > $node->value) {
			$node->right = $this->createLeaf($value);
			$this->numNodes++;
		} else if ($value < $node->value && $node->left) {
			$this->pushToNode($value, $node->left);
		} else if ($value < $node->value) {
			$node->left = $this->createLeaf($value);
			$this->numNodes++;
		}
	}

	/**
	* Creates a new node with the passed in value and returns it
	* @param string|int $value
	* @return Node
	*/
	private function createLeaf ($value) {
		return new Node ($value);
	}

	/**
	* Checks if $value is present or not in the tree
	* @return boolean
	*/
	public function find ($value) {
		if (!$this->root) { return false; }
		else {
			return $this->findFromNode($value, $this->root);
		}
	}

	/**
	* Checks if $value is present or not in the tree starting from $node
	*/
	public function findFromNode ($value, $node) {
		if ($node->value == $value) {
			return true;
		} else if ($node->value < $value && $node->right) {
			return $this->findFromNode($value, $node->right);
		} else if ($node->value > $value && $node->left) {
			return $this->findFromNode($value, $node->left);
		} else {
			return false;
		}
	}

	/**
	* Returns the current number of nodes in the tree
	* @return int
	*/
	public function getNumNodes () {
		return $this->numNodes;
	}


}
