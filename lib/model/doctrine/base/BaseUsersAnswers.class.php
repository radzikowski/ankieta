<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('UsersAnswers', 'doctrine');

/**
 * BaseUsersAnswers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $user_id
 * @property integer $question_id
 * @property integer $answer_id
 * @property string $answer_text
 * @property integer $points
 * @property timestamp $created_at
 * @property Users $Users
 * 
 * @method string       getUserId()      Returns the current record's "user_id" value
 * @method integer      getQuestionId()  Returns the current record's "question_id" value
 * @method integer      getAnswerId()    Returns the current record's "answer_id" value
 * @method string       getAnswerText()  Returns the current record's "answer_text" value
 * @method integer      getPoints()      Returns the current record's "points" value
 * @method timestamp    getCreatedAt()   Returns the current record's "created_at" value
 * @method Users        getUsers()       Returns the current record's "Users" value
 * @method UsersAnswers setUserId()      Sets the current record's "user_id" value
 * @method UsersAnswers setQuestionId()  Sets the current record's "question_id" value
 * @method UsersAnswers setAnswerId()    Sets the current record's "answer_id" value
 * @method UsersAnswers setAnswerText()  Sets the current record's "answer_text" value
 * @method UsersAnswers setPoints()      Sets the current record's "points" value
 * @method UsersAnswers setCreatedAt()   Sets the current record's "created_at" value
 * @method UsersAnswers setUsers()       Sets the current record's "Users" value
 * 
 * @package    ibum
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsersAnswers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('users_answers');
        $this->hasColumn('user_id', 'string', 70, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 70,
             ));
        $this->hasColumn('question_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('answer_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('answer_text', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('points', 'integer', 2, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 2,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Users', array(
             'local' => 'user_id',
             'foreign' => 'id'));
    }
}