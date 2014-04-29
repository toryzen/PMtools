<?php

$config = array(
    'tools/docs/index' => array(
                                    array('field' => 'bname','label' => 'bname','rules' => 'trim|required|max_length[50]'),
                             ),
    'tools/docs/edit' => array(
                                    array('field' => 'bname','label' => 'bname','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'dwz','label' => 'dwz','rules' => 'trim')
                            ),
    'tools/meeting/index' => array(
                                    array('field' => 'bname','label' => 'bname','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'meeting[]','label' => 'meeting[]','rules' => 'trim')
                            ),
    'tools/meeting/edit' => array(
                                    array('field' => 'bname','label' => 'bname','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'meeting[]','label' => 'meeting[]','rules' => 'trim'),
                                    array('field' => 'dwz','label' => 'dwz','rules' => 'trim')
                            ),
    'tools/plan/index' => array(
                                    array('field' => 'plan[bname]','label' => 'plan[bname]','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'plan[begintime]','label' => 'plan[begintime]','rules' => 'trim|required'),
                                    array('field' => 'plan[endtime]','label' => 'plan[endtime]','rules' => 'trim|required'),
                                    array('field' => 'task[]','label' => 'task[]','rules' => 'trim'),
                                    array('field' => 'milestone[]','label' => 'milestone[]','rules' => 'trim')
                            ),
    'tools/plan/edit' => array(
                                    array('field' => 'plan[bname]','label' => 'plan[bname]','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'plan[begintime]','label' => 'plan[begintime]','rules' => 'trim|required'),
                                    array('field' => 'plan[endtime]','label' => 'plan[endtime]','rules' => 'trim|required'),
                                    array('field' => 'task[]','label' => 'task[]','rules' => 'trim'),
                                    array('field' => 'milestone[]','label' => 'milestone[]','rules' => 'trim'),
                                    array('field' => 'dwz','label' => 'dwz','rules' => 'trim')
                            ),
    'tools/setup/index' => array(
                                    array('field' => 'bname','label' => 'bname','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'describ','label' => 'describ','rules' => 'trim|required'),
                                    array('field' => 'background','label' => 'background','rules' => 'trim|required'),
                                    array('field' => 'demand','label' => 'demand','rules' => 'trim|required'),
                                    array('field' => 'meaning','label' => 'meaning','rules' => 'trim|required'),
                                    array('field' => 'other[]','label' => 'other[]','rules' => 'trim')
                            ),
    'tools/setup/edit' => array(
                                    array('field' => 'bname','label' => 'bname','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'describ','label' => 'describ','rules' => 'trim|required'),
                                    array('field' => 'background','label' => 'background','rules' => 'trim|required'),
                                    array('field' => 'demand','label' => 'demand','rules' => 'trim|required'),
                                    array('field' => 'meaning','label' => 'meaning','rules' => 'trim|required'),
                                    array('field' => 'other[]','label' => 'other[]','rules' => 'trim'),
                                    array('field' => 'dwz','label' => 'dwz','rules' => 'trim')
                            ),
    'tools/tasks/index' => array(
                                    array('field' => 'borad[bname]','label' => 'borad[bname]','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'borad[begintime]','label' => 'borad[begintime]','rules' => 'trim|required'),
                                    array('field' => 'borad[endtime]','label' => 'borad[endtime]','rules' => 'trim|required'),
                                    array('field' => 'task[]','label' => 'task[]','rules' => 'trim')
                            ),
    'tools/tasks/edit' => array(
                                    array('field' => 'borad[bname]','label' => 'borad[bname]','rules' => 'trim|required|max_length[50]'),
                                    array('field' => 'borad[begintime]','label' => 'borad[begintime]','rules' => 'trim|required'),
                                    array('field' => 'borad[endtime]','label' => 'borad[endtime]','rules' => 'trim|required'),
                                    array('field' => 'task[]','label' => 'task[]','rules' => 'trim'),
                                    array('field' => 'dwz','label' => 'dwz','rules' => 'trim')
                            )
               );