<?php

class ProjectModel extends MFW_Model
{
    public function __construct(MFW_Db_Table $table)
    {
        $table->setTable('projects');
        $table->setSequence('projects_id_seq');

        $this->table = $table;
    }

    protected function getTableColumnsList()
    {
        return array('id', 'username', 'title', 'slug', 'intro', 'description', 'github', 'download', 'version', 'timestamp');
    }

    public function getProjects()
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          null,
                                          'timestamp desc');

        return $this->parseRecordset($recordset);
    }

    public function createProject(Project_Create_Form $form)
    {
        if ($this->doesSlugExist($form->getField('slug')->getData())) {
            return false;
        }

        $data = array('title' => $form->getField('title')->getData(),
                      'slug' => $form->getField('slug')->getData(),
                      'intro' => $form->getField('intro')->getData(),
                      'description' => $form->getField('description')->getData(),
                      'github' => $form->getField('github')->getData(),
                      'download' => $form->getField('download')->getData(),
                      'version' => $form->getField('version')->getData(),
                      'username' => 'phordijk',
                      );

        return $this->table->insert($data);
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

    protected function parseRecordset($recordset)
    {
        $projects = array();
        foreach($recordset as $record) {
            $project = new StdClass();

            $project->id = $record['id'];
            $project->username = $record['username'];
            $project->title = $record['title'];
            $project->slug = $record['slug'];
            $project->intro = $record['intro'];
            $project->description = $record['description'];
            $project->github = $record['github'];
            $project->download = $record['download'];
            $project->version = $record['version'];
            $project->timestamp = $record['timestamp'];

            $projects[$project->id] = $project;
        }

        return $projects;
    }
}