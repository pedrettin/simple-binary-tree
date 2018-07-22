<?php

include('./BinaryTree.php');
use PHPUnit\Framework\TestCase;

class BinaryTreeTest extends TestCase {

	public function testCreate () {
		$Tree = new BinaryTree();
		$this->assertTrue(is_a($Tree, 'BinaryTree'));
	}

	public function testPushRoot () {
		$Tree = new BinaryTree();
		$Tree->push(10);
		$this->assertTrue($Tree->getNumNodes() == 1);
		return $Tree;
	}

	/**
	* @depends testPushRoot
	*/
	public function testPushExistingNode ($Tree) {
		$Tree->push(10);
		$this->assertTrue($Tree->getNumNodes() == 1);
		return $Tree;
	}

	/**
	* @depends testPushExistingNode
	*/
	public function testPushLowerElement ($Tree) {
		$Tree->push(7);
		$this->assertTrue($Tree->getNumNodes() == 2);
		return $Tree;
	}

	/**
	* @depends testPushLowerElement
	*/
	public function testPushHigherElement ($Tree) {
		$Tree->push(15);
		$this->assertTrue($Tree->getNumNodes() == 3);
		return $Tree;
	}

	/**
	* @depends testPushHigherElement
	*/
	public function testPushSeveralElements ($Tree) {
		$Tree->push(11);
		$Tree->push(5);
		$Tree->push(6);
		$Tree->push(7); // already pushed shouldnt go in
		$Tree->push(3);
		$this->assertTrue($Tree->getNumNodes() == 7);
		return $Tree;
	}

	/**
	* @depends testPushSeveralElements
	*/
	public function testFind ($Tree) {
		$this->assertTrue($Tree->find(10));
		$this->assertTrue($Tree->find(7));
		$this->assertTrue($Tree->find(15));
		$this->assertTrue($Tree->find(5));
		$this->assertTrue($Tree->find(6));
		$this->assertTrue($Tree->find(3));
		$this->assertTrue($Tree->find(11));
		$this->assertFalse($Tree->find(1));
		$this->assertFalse($Tree->find(0));
		$this->assertFalse($Tree->find("hi"));
	}

	/**
	* @depends testPushSeveralElements
	*/
	public function testRemoveNoChildren ($Tree) {
		$Tree->remove(3);
		$this->assertFalse($Tree->find(3));
		$this->assertTrue($Tree->getNumNodes() == 6);
		return $Tree;
	}

	/**
	* @depends testRemoveNoChildren
	*/
	public function testRemoveOneChild ($Tree) {
		$Tree->remove(15);
		$this->assertFalse($Tree->find(15));
		$this->assertTrue($Tree->getNumNodes() == 5);
		return $Tree;
	}

	/**
	* @depends testRemoveOneChild
	*/
	public function testRemoveTwoChildren ($Tree) {
		$Tree->push(3);
		$Tree->push(1);
		$Tree->push(2);
		$Tree->remove(5);
		$this->assertTrue($Tree->find(2));
		$this->assertTrue($Tree->find(1));
		$this->assertTrue($Tree->find(3));
		$this->assertFalse($Tree->find(5));
		$this->assertFalse($Tree->find(15));
		$this->assertTrue($Tree->find(10));
		$this->assertTrue($Tree->getNumNodes() == 7);
	}

}

?>
