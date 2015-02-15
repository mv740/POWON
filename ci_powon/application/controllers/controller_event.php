<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_event extends CI_Controller {

    public function createEventPage($group_id) {
        $data['title'] = "Create Event";
        $data['group_id'] = $group_id;
        $this->load->view('templates/header',$data);
        $this->load->view('view_create_event');
        $this->load->view('templates/footer');
    }

	public function createEvent($group_id){

        $this->load->model('model_event');
        $this->load->model('model_poll');

        $data['group_id'] = $group_id;
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        

        //create new event in event table
        $eventData = array (
            'name' => $name,
            'description' => $description,
            'group_id' => $group_id
        );
        
        $event_id = $this->model_event->insertNewEvent($eventData);

        $pollData = array (
            'event_id' => $event_id
            );

        $this->model_poll->insertNewPoll($pollData);
        redirect("controller_group/groupPage/".$data['group_id'], 'refresh');
    }
    public function eventPage($event_id) {

        $this->load->model('model_event');
        $this->load->model('model_group');
        //$this->load->model('model_poll');

        $powon_id = $this->session->userdata('powon_id');

        $data['eventsInfo'] = $this -> model_event -> getEventInfo($event_id);

        $eventInfo = $this -> model_event -> getEventInfo($event_id);
        $datapollid = $this -> model_event -> getPollInfo($event_id);

        foreach($eventInfo as $row) {
        $group_id = $row->group_id;
        
    }
        foreach($datapollid as $row) {
        $poll_id = $row->poll_id;
        
    }
        $data['poll_id'] = $poll_id;
        $data['suggData'] = $this -> model_event -> getSuggInfo($poll_id);
        $data['hasVoted'] = $this -> model_event -> memberHasVoted($powon_id, $poll_id);
        $data['winner'] = $this-> model_event -> SelectedSuggestion();
        $data['pollOpen'] = $this-> model_event-> isPoolOpen($poll_id);
        
        $data['groupInfo'] = $this-> model_group-> getGroupInfo($group_id);




        $data['title'] = 'Event Page';
        
        //$data['pollInfo'] = $this -> model_poll -> getAllPollSugestions($poll_id);

        $this->load->view('templates/header',$data);
        $this->load->view('view_event');
        $this->load->view('templates/footer');
    }
    public function addSuggestion($event_id){

        $this->load->model('model_event');

        $date = $this->input->post('date');
        $place = $this->input->post('place');
        $event_id = $this->input->post('event_id');

        $data = $this -> model_event -> getPollInfo($event_id);
        foreach($data as $row) {
        $poll_id = $row->poll_id;
        
    }


        $suggestionData = array (
            'poll_poll_id' => $poll_id,
            'date' => $date,
            'place' => $place
            );

        $this->model_event->insertNewSuggestion($suggestionData);

        redirect("controller_event/eventPage/".$event_id, 'refresh');
    }
    public function addVote($event_id){

         $this->load->model('model_event');
        $suggestion_id = $this->input->post('suggestion_id');
        $poll_id = $this->input->post('poll_id');

        $this -> model_event -> vote($suggestion_id);
        $powon_id = $this->session->userdata('powon_id');

        $memberVoted = array (
            'poll_id' => $poll_id,
            'powon_id' => $powon_id
            );

        $this -> model_event -> memberVoted($memberVoted);

        redirect("controller_event/eventPage/".$event_id, 'refresh');
    }
    public function closePoll($event_id){

         $this->load->model('model_event');
        $poll_id = $this->input->post('poll_id');

        $this -> model_event -> closePoll($poll_id);

        redirect("controller_event/eventPage/".$event_id, 'refresh');
    }
    public function removeEventFromGroup($event_id) {

        $this -> load-> model("model_event");
        $group_id = $this->input->post('group_id');
        $eventData = array (
            'event_id' => $event_id,
            
        );

        $this->model_event->deleteEvent($eventData);
        redirect("controller_group/groupPage/$group_id", 'refresh');
    }


}