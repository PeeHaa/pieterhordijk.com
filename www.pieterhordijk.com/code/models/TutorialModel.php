<?php

class TutorialModel extends MFW_Model
{
    public function __construct(MFW_Db_Table $table)
    {
        $table->setTable('tutorials');
        $table->setSequence('tutorials_id_seq');

        $this->table = $table;
    }

    protected function getTableColumnsList()
    {
        return array('id', 'username', 'title', 'slug', 'intro', 'keywords', 'image', 'text', 'timestamp');
    }

    public function getTutorials()
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          null,
                                          'timestamp desc');

        return $this->parseRecordset($recordset);
    }

    public function createTutorial(Tutorial_Create_Form $form, $username)
    {
        if ($this->doesSlugExist($form->getField('slug')->getData())) {
            return false;
        }

        $data = array('title' => $form->getField('title')->getData(),
                      'slug' => $form->getField('slug')->getData(),
                      'intro' => $form->getField('intro')->getData(),
                      'keywords' => $form->getField('keywords')->getData(),
                      'text' => $form->getField('text')->getData(),
                      'image' => $form->getField('image')->getData(),
                      'username' => $username,
                      );

        return $this->table->insert($data);
    }

    public function updateTutorial(Tutorial_Edit_Form $form)
    {
        $data = array('title' => $form->getField('title')->getData(),
                      'slug' => $form->getField('slug')->getData(),
                      'intro' => $form->getField('intro')->getData(),
                      'keywords' => $form->getField('keywords')->getData(),
                      'text' => $form->getField('text')->getData(),
                      );

        if ($form->getField('image')->getData()) {
            $data['image'] = $form->getField('image')->getData();
        }

        return $this->table->update($data,
                                    $this->table->where('id = ?', $form->getField('id')->getData()));
    }

    public function deleteTutorialsByIds($ids)
    {
        if (!is_array($ids)) {
            $ids = array($ids);
        }

        $this->table->delete($this->table->where('id in (??)', $ids));
    }

    protected function doesSlugExist($slug)
    {
        $recordset = $this->table->select('id',
                                          $this->table->where('slug = ?', $slug));

        if ($recordset) {
            return true;
        }

        return false;
    }

    public function getTutorialBySlug($slug)
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          $this->table->where('slug = ?', $slug));

        if (!$recordset) {
            return null;
        }

        $tutorials = $this->parseRecordset($recordset);
        return reset($tutorials);
    }

    protected function parseRecordset($recordset)
    {
        $tutorials = array();
        foreach($recordset as $record) {
            $tutorial = new StdClass();

            $tutorial->id = $record['id'];
            $tutorial->username = $record['username'];
            $tutorial->title = $record['title'];
            $tutorial->slug = $record['slug'];
            $tutorial->intro = $record['intro'];
            $tutorial->keywords = $record['keywords'];
            $tutorial->text = $record['text'];
            $tutorial->image = $record['image'];
            $tutorial->timestamp = $record['timestamp'];

            $tutorials[$tutorial->id] = $tutorial;
        }

        return $tutorials;
    }
}