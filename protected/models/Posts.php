<?php

/**
 * This is the model class for table "mybb_posts".
 *
 * The followings are the available columns in table 'mybb_posts':
 * @property string $pid
 * @property string $tid
 * @property string $replyto
 * @property integer $fid
 * @property string $subject
 * @property integer $icon
 * @property string $uid
 * @property string $username
 * @property string $dateline
 * @property string $message
 * @property string $ipaddress
 * @property integer $longipaddress
 * @property integer $includesig
 * @property integer $smilieoff
 * @property string $edituid
 * @property integer $edittime
 * @property integer $visible
 * @property string $posthash
 */
class Posts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mybb_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message', 'required'),
			array('fid, icon, longipaddress, includesig, smilieoff, edittime, visible', 'numerical', 'integerOnly'=>true),
			array('tid, replyto, uid, edituid', 'length', 'max'=>10),
			array('subject', 'length', 'max'=>120),
			array('username', 'length', 'max'=>80),
			array('dateline, ipaddress', 'length', 'max'=>30),
			array('posthash', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pid, tid, replyto, fid, subject, icon, uid, username, dateline, message, ipaddress, longipaddress, includesig, smilieoff, edituid, edittime, visible, posthash', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'threads' => array(self::BELONGS_TO, 'Threads', 'tid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pid' => 'Pid',
			'tid' => 'Tid',
			'replyto' => 'Replyto',
			'fid' => 'Fid',
			'subject' => 'Subject',
			'icon' => 'Icon',
			'uid' => 'Uid',
			'username' => 'Username',
			'dateline' => 'Dateline',
			'message' => 'Message',
			'ipaddress' => 'Ipaddress',
			'longipaddress' => 'Longipaddress',
			'includesig' => 'Includesig',
			'smilieoff' => 'Smilieoff',
			'edituid' => 'Edituid',
			'edittime' => 'Edittime',
			'visible' => 'Visible',
			'posthash' => 'Posthash',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pid',$this->pid,true);
		$criteria->compare('tid',$this->tid,true);
		$criteria->compare('replyto',$this->replyto,true);
		$criteria->compare('fid',$this->fid);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('icon',$this->icon);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('dateline',$this->dateline,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('ipaddress',$this->ipaddress,true);
		$criteria->compare('longipaddress',$this->longipaddress);
		$criteria->compare('includesig',$this->includesig);
		$criteria->compare('smilieoff',$this->smilieoff);
		$criteria->compare('edituid',$this->edituid,true);
		$criteria->compare('edittime',$this->edittime);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('posthash',$this->posthash,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    
}
