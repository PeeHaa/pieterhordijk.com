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
        return array('id', 'username', 'title', 'slug', 'intro', 'description', 'keywords', 'image', 'github', 'download', 'version', 'timestamp');
    }

    public function getProjects()
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          null,
                                          'timestamp desc');

        return $this->parseRecordset($recordset);
    }

    public function createProject(Project_Create_Form $form, $username)
    {
        if ($this->doesSlugExist($form->getField('slug')->getData())) {
            return false;
        }

        $data = array('title' => $form->getField('title')->getData(),
                      'slug' => $form->getField('slug')->getData(),
                      'intro' => $form->getField('intro')->getData(),
                      'keywords' => $form->getField('keywords')->getData(),
                      'description' => $form->getField('description')->getData(),
                      'image' => $form->getField('image')->getData(),
                      'github' => $form->getField('github')->getData(),
                      'download' => $form->getField('download')->getData(),
                      'version' => $form->getField('version')->getData(),
                      'username' => $username,
                      );

        return $this->table->insert($data);
    }

    public function updateProject(Project_Edit_Form $form)
    {
        $data = array('title' => $form->getField('title')->getData(),
                      'slug' => $form->getField('slug')->getData(),
                      'intro' => $form->getField('intro')->getData(),
                      'keywords' => $form->getField('keywords')->getData(),
                      'description' => $form->getField('description')->getData(),
                      'github' => $form->getField('github')->getData(),
                      'download' => $form->getField('download')->getData(),
                      'version' => $form->getField('version')->getData(),
                      );

        if ($form->getField('image')->getData()) {
            $data['image'] = $form->getField('image')->getData();
        }

        return $this->table->update($data,
                                    $this->table->where('id = ?', $form->getField('id')->getData()));
    }

    public function deleteProjectsByIds($ids)
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

    public function getProjectBySlug($slug)
    {
        $recordset = $this->table->select($this->getTableColumns(),
                                          $this->table->where('slug = ?', $slug));

        if (!$recordset) {
            return null;
        }

        $projects = $this->parseRecordset($recordset);
        return reset($projects);
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
            $project->keywords = $record['keywords'];
            $project->description = $record['description'];
            $project->image = $record['image'];
            $project->github = $record['github'];
            $project->download = $record['download'];
            $project->version = $record['version'];
            $project->timestamp = $record['timestamp'];

            $projects[$project->id] = $project;
        }

        return $projects;
    }
}