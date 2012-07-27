<?php

/**
 * This is the model class for table "mybb_threads".
 *
 * The followings are the available columns in table 'mybb_threads':
 * @property string $tid
 * @property integer $fid
 * @property string $subject
 * @property integer $prefix
 * @property integer $icon
 * @property string $poll
 * @property string $uid
 * @property string $username
 * @property string $dateline
 * @property string $firstpost
 * @property string $lastpost
 * @property string $lastposter
 * @property string $lastposteruid
 * @property integer $views
 * @property integer $replies
 * @property string $closed
 * @property integer $sticky
 * @property integer $numratings
 * @property integer $totalratings
 * @property string $notes
 * @property integer $visible
 * @property string $unapprovedposts
 * @property string $attachmentcount
 * @property string $deletetime
 */
class Threads extends CActiveRecord
{
	public $length;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Threads the static model class
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
		return 'mybb_threads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notes', 'required'),
			array('fid, prefix, icon, views, replies, sticky, numratings, totalratings, visible', 'numerical', 'integerOnly'=>true),
			array('subject, lastposter', 'length', 'max'=>120),
			array('poll, uid, firstpost, lastposteruid, unapprovedposts, attachmentcount, deletetime', 'length', 'max'=>10),
			array('username', 'length', 'max'=>80),
			array('dateline, lastpost, closed', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tid, fid, subject, prefix, icon, poll, uid, username, dateline, firstpost, lastpost, lastposter, lastposteruid, views, replies, closed, sticky, numratings, totalratings, notes, visible, unapprovedposts, attachmentcount, deletetime', 'safe', 'on'=>'search'),
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
			'posts' => array(self::HAS_MANY, 'Posts', 'tid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tid' => 'Tid',
			'fid' => 'Fid',
			'subject' => 'Subject',
			'prefix' => 'Prefix',
			'icon' => 'Icon',
			'poll' => 'Poll',
			'uid' => 'Uid',
			'username' => 'Username',
			'dateline' => 'Dateline',
			'firstpost' => 'Firstpost',
			'lastpost' => 'Lastpost',
			'lastposter' => 'Lastposter',
			'lastposteruid' => 'Lastposteruid',
			'views' => 'Views',
			'replies' => 'Replies',
			'closed' => 'Closed',
			'sticky' => 'Sticky',
			'numratings' => 'Numratings',
			'totalratings' => 'Totalratings',
			'notes' => 'Notes',
			'visible' => 'Visible',
			'unapprovedposts' => 'Unapprovedposts',
			'attachmentcount' => 'Attachmentcount',
			'deletetime' => 'Deletetime',
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

		$criteria->compare('tid',$this->tid,true);
		$criteria->compare('fid',$this->fid);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('prefix',$this->prefix);
		$criteria->compare('icon',$this->icon);
		$criteria->compare('poll',$this->poll,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('dateline',$this->dateline,true);
		$criteria->compare('firstpost',$this->firstpost,true);
		$criteria->compare('lastpost',$this->lastpost,true);
		$criteria->compare('lastposter',$this->lastposter,true);
		$criteria->compare('lastposteruid',$this->lastposteruid,true);
		$criteria->compare('views',$this->views);
		$criteria->compare('replies',$this->replies);
		$criteria->compare('closed',$this->closed,true);
		$criteria->compare('sticky',$this->sticky);
		$criteria->compare('numratings',$this->numratings);
		$criteria->compare('totalratings',$this->totalratings);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('visible',$this->visible);
		$criteria->compare('unapprovedposts',$this->unapprovedposts,true);
		$criteria->compare('attachmentcount',$this->attachmentcount,true);
		$criteria->compare('deletetime',$this->deletetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}	
	/**
	 * hotThread return the hot threads of the foro
	 * @param  string  $type   [description]
	 * @param  integer $length [description]
	 * @return [type]          [description]
	 */
	public function hotThread($type = 'views', $length = 5)
	{
		if($type == 'views') {
			$criteria = new CDbCriteria();
			$criteria->select = 'tid, subject, views, dateline, username';
			$criteria->with = array(
				'posts'=>array(      			        				
        			'joinType'=>'LEFT JOIN', 
        			'order' => 'pid',        			       			
    			),
			);			
			$criteria->order = 'views DESC';
			$criteria->together = true;			
			$criteria->limit = $length;
            $dataProvider = new CActiveDataProvider($this, array(
                'criteria' => $criteria,                                    
                'pagination'=>array(
                    'pageSize'=>20,
                ),
            ));            
        } elseif($type == 'answerd') {
        	$criteria = new CDbCriteria();
			$criteria->select = 'tid, COUNT(posts.tid) as length, subject, views, dateline, username';			
			$criteria->order = 'length DESC';	
			$criteria->with = array(
				'posts'=>array(      			        			
        			'joinType'=>'RIGHT JOIN',  
        			'order' => 'pid',      			
    			),
			);
			$criteria->together = true;			
			$criteria->group = 'posts.tid';
			$criteria->limit = $length;
            $dataProvider = new CActiveDataProvider($this, array(
                'criteria' => $criteria,                                                    
            ));
        }
        return $dataProvider;
	}
}