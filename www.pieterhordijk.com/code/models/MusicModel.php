<?php

class MusicModel extends MFW_Model
{
    public function __construct(MFW_Db_Table $table)
    {
        $table->setTable('music');
        $table->setSequence('music_id_seq');

        $this->table = $table;
    }

    protected function getTableColumnsList()
    {
        return array('id', 'soundcloud_id');
    }

    public function getTracks()
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          null,
                                          'id desc');

        return $this->parseRecordset($recordset);
    }

    public function addTrack(Track_Add_Form $form)
    {
        $data = array('soundcloud_id' => $form->getField('id')->getData(),
                      );

        return $this->table->insert($data);
    }

    public function deleteTracksByIds(array $ids)
    {
        if (!is_array($ids)) {
            $ids = array($ids);
        }

        $this->table->delete($this->table->where('id in (??)', $ids));
    }

    public function getTrackById($id)
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          $this->table->where('id = ?', $id));

        if (!$recordset) {
            return null;
        }

        $tracks = $this->parseRecordset($recordset);
        return reset($projects);
    }

    protected function parseRecordset(array $recordset)
    {
        $tracks = array();
        foreach($recordset as $record) {
            $track = new StdClass();

            $track->id = $record['id'];
            $track->soundcloudId = $record['soundcloud_id'];

            $tracks[$track->id] = $track;
        }

        return $tracks;
    }
}