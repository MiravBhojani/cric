<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public $is_admin, $club_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language']);
		$this->load->helper('download');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		$this->auth_user_id = $this->ion_auth->user()->row()->id;
		$this->is_admin = $this->auth_user_id == 1;
		$this->club_id = $this->getClubID();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function admin()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

//		// Check if the logged-in user is in the 'admin' group
//		if (!$this->ion_auth->in_group('admin')) {
//			// If not in the 'admin' group, show an unauthorized message or redirect to another page
//			// Example: Show an error message or redirect to a different page
//			echo "Unauthorized access"; // Or redirect to a different page
//			// redirect('other_page', 'refresh');
//			return;
//		}

		$this->load->view('admin');
	}

	public function create_club()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['is_admin'] = $this->is_admin;
		$this->load->view('create_club', $data);
	}

	public function clubs()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['clubs'] = $this->db->get('clubs')->result_array();
		$data['is_admin'] = $this->is_admin;
		$this->load->view('club_list', $data);


	}

	public function exportCSV()
	{
		// Load data from the BattingLeaderboard table
		$battingData = $this->db->get('battingleaderboard')->result_array();

		// Load data from the BowlingReport table
		$bowlingData = $this->db->get('bowlingreport')->result_array();

		// Create CSV content for BattingLeaderboard
		$battingCsvContent = $this->arrayToCsv($battingData);

		// Set the file name for BattingLeaderboard
		$battingFileName = 'batting_leaderboard.csv';

		// Force download the BattingLeaderboard CSV file
		force_download($battingFileName, $battingCsvContent);

		// Create CSV content for BowlingReport
		$bowlingCsvContent = $this->arrayToCsv($bowlingData);

		// Set the file name for BowlingReport
		$bowlingFileName = 'bowling_report.csv';

		// Force download the BowlingReport CSV file
		force_download($bowlingFileName, $bowlingCsvContent);
	}

	public function bexportCSV()
	{
		// Load data from the BowlingReport table
		$bowlingData = $this->db->get('bowlingreport')->result_array();

		// Create CSV content for BowlingReport
		$bowlingCsvContent = $this->arrayToCsv($bowlingData);

		// Set the file name for BowlingReport
		$bowlingFileName = 'bowling_report.csv';

		// Send BowlingReport CSV file to the browser
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $bowlingFileName . '"');
		echo $bowlingCsvContent;

		// Terminate script execution after sending the file
		exit();
	}


	private function arrayToCsv($array)
	{
		$output = fopen('php://temp', 'w');
		foreach ($array as $row) {
			fputcsv($output, $row);
		}
		rewind($output);
		$csv = stream_get_contents($output);
		fclose($output);
		return $csv;
	}


	public function create_match()
	{
		if (!$this->ion_auth->logged_in()) {
			// Redirect users who are not logged in to the login page
			redirect('auth/login', 'refresh');
		}

		// Fetch clubs from the 'clubs' table
		$data['clubs'] = $this->db->get('clubs')->result_array();

		// Fetch home grounds from the 'grounds' table (or the table where grounds are stored)
		$data['homeGrounds'] = $this->db->get('clubs')->result_array();
		$data['is_admin'] = $this->is_admin;

		$this->load->view('create_match', $data);
	}


	public function creatematchpost()
	{
		if (!$this->ion_auth->logged_in()) {
			// Redirect users who are not logged in to the login page
			redirect('auth/login', 'refresh');
		}

		// Retrieve form data
		$homeTeam = $this->input->post('homeTeam');
		$awayTeam = $this->input->post('awayTeam');
		$datePlayed = $this->input->post('datePlayed');
		$homeGround = $this->input->post('homeGround');
		$userId = $this->ion_auth->get_user_id();
		$lastUpdated = date('Y-m-d H:i:s'); // Get the current date/time

		// Insert data into 'matches' table
		$data = array(
			'hometeam' => $homeTeam,
			'awayteam' => $awayTeam,
			'dateplayed' => $datePlayed,
			'homeground' => $homeGround,
			'userid' => $userId,
			'lastupdated' => $lastUpdated // Changed field name to 'lastupdated'
		);

		$this->db->insert('matches', $data);

		if ($this->db->affected_rows() > 0) {
			// Insertion successful
			// Redirect to a success page or perform any further actions
			// For example:
			redirect('Welcome/matches', 'refresh');
		} else {
			// Insertion failed
			echo 'Failed to create the match';
		}
	}


	public function matches()
	{
		if (!$this->ion_auth->logged_in()) {
			// Redirect users who are not logged in to the login page
			redirect('auth/login', 'refresh');
		}

		// Fetch matches data from the 'matches' table
		$data['is_admin'] = $this->is_admin;

		$result = $this->db->select('match.id as match_id,match.dateplayed,match.homeground,match.completed,home_team.clubname as ht_name,away_team.clubname as at_name,away_team.id as at_id,home_team.id as ht_id')
			->from('matches as match')
			->join('clubs as home_team', 'match.hometeam = home_team.id')
			->join('clubs as away_team', 'match.awayteam = away_team.id');

		if (!$this->is_admin) {
			$result = $result->where("home_team.id = $this->club_id OR away_team.id = $this->club_id");
		}

		$result = $result->get()->result_array();

		$data['matches'] = $result;
		$this->load->view('matches_list', $data);
	}

	/**
	 * @return void
	 */
	public function leaderboard()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$id = $this->input->post('s1_id');
		if (!isset($id)) {
			$data['is_admin'] = $this->is_admin;
			$this->load->view('admin_leaderboard', $data);
			return;
		}

		// Get all players from the 'players' table
		$players = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->join('clubs as club', 'match_players.club_id = club.id')
			->where("toss_winner = '1' AND s1_id = $id")
			->get()->result_array();

		$data['is_admin'] = $this->is_admin;

//		$existing = $this->db->select('*')
//			->from('s4')
//			->where("s1_id = $id")
//			->get()->result_array();
//
//		foreach ($existing as $value) {
//			$this->load->view('admin_leaderboard', $data);
//			return;
//		}

		foreach ($players as $value) {
			$player_id = $value['player_id'];
			$insert = [
				'bowled' => $this->input->post('bowled_' . $value['player_id']),
				'overs_bowled' => $this->input->post('overs_bowled_' . $value['player_id']),
				'runs_given' => $this->input->post('runs_given_' . $value['player_id']),
				'wickets_taken' => $this->input->post('wickets_taken_' . $value['player_id']),
				'economy' => $this->input->post('economy_' . $value['player_id'])
			];
			$this->db->where("s1_id = $id AND player_id = $player_id");
			$this->db->update('match_players', $insert);
		}

		// Insert data into 'matches' table
		$insert = [
			's1_id' => $id,
			'completed' => '1'
		];
		$this->db->insert('s4', $insert);

		$this->db->where("id = $id");
		$this->db->update('s1', ['completed' => '1']);

		$this->db->where("s1_id = $id");
		$this->db->update('s2', ['completed' => '1']);

		$this->db->where("s1_id = $id");
		$this->db->update('s3', ['completed' => '1']);

		$this->db->where("s1_id = $id");
		$this->db->update('s3', ['completed' => '1']);

		//update matches
		$s1 = $this->db->select("*")
			->from("s1")
			->where("id = $id")
			->get()->result_array();

		$matchID = null;
		foreach ($s1 as $value) {
			$update = [
				'completed' => 1,
			];
			$matchID = $value['match_id'];
			$this->db->where("id = $matchID");
			$this->db->update('matches', $update);

			log_message("error", "Match ID = $matchID");
		}

		//update all matches
		$players = $this->db->select("match_players.*, player.name as player_name,player.id as player_id")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->where("s1_id = $id AND completed=0")
			->get()->result_array();

		foreach ($players as $value) {
			$insert = [
				'completed' => 1,
			];
			$this->db->where("s1_id = $id");
			$this->db->update('match_players', $insert);


			//update batting
			$player_batting = $this->db->select("*")
				->from('battingleaderboard')
				->where("player_id = " . $value['player_id'])
				->get()->result_array();

			$batting = [];
			$updated = false;
			foreach ($player_batting as $battingValue) {
				$runs = $battingValue['runs'] + $value['runs'];
				$wickets = $battingValue['wickets_taken'] + $value['wickets_taken'];
				$overs_bowled = $battingValue['overs_bowled'] + $value['overs_bowled'];
				$matches = $battingValue['matches'] + 1;

				$bowls = $value['overs_bowled'] * 6;
				$averages = $wickets >0 ? $runs/$wickets : 0;
				$average_2 = $matches >0 ? $runs/$matches : 0;
				$economy = $overs_bowled >0 ? $runs/$overs_bowled : 0;

				$updated = true;
				$batting['wickets_taken'] = $wickets;
				$batting['overs_bowled'] = $overs_bowled;
				$batting['player_id'] = $value['player_id'];
				$batting['match_id'] = $matchID;
				$batting['player_name'] = $battingValue['player_name'];
				$batting['matches'] = $matches;
				$batting['runs'] = $runs;
				$batting['bowls'] = $battingValue['bowls'] + $bowls;
				$batting['outs'] = $battingValue['outs'] + $value['in_out'];
				$batting['average'] = round($average_2,2);
				$batting['performanceruns5'] = $value['runs'];
				$batting['performanceruns4'] = $battingValue['performanceruns5'];
				$batting['performanceruns3'] = $battingValue['performanceruns4'];
				$batting['performanceruns2'] = $battingValue['performanceruns3'];
				$batting['performanceruns1'] = $battingValue['performanceruns2'];

				$this->db->where("player_id = " . $value['player_id']);
				$this->db->update('battingleaderboard', $batting);
			}
			if (!$updated) {

				$runs = $value['runs'];
				$wickets = $value['wickets_taken'];

				$bowls = $value['overs_bowled'] * 6;
				$averages = $wickets >0 ? $runs/$wickets : 0;
				$average_2 = $runs;

				$batting['wickets_taken'] = $value['wickets_taken'];
				$batting['overs_bowled'] = $value['overs_bowled'];
				$batting['player_id'] = $value['player_id'];
				$batting['match_id'] = $matchID;
				$batting['player_name'] = $value['player_name'];
				$batting['matches'] = 1;
				$batting['runs'] = $value['runs'];
				$batting['bowls'] = $bowls;
				$batting['outs'] = $value['in_out'];
				$batting['average'] = round($average_2,2);
				$batting['performanceruns5'] = $value['runs'];
				$this->db->insert('battingleaderboard', $batting);
			}


			//update bowling
			$player_bowling = $this->db->select("*")
				->from('bowlingreport')
				->where("player_id = " . $value['player_id'])
				->get()->result_array();
			$updated = false;

			$bowling = [];
			foreach ($player_bowling as $bowlingValue) {
				$runs = $bowlingValue['runsgiven'] + $value['runs_given'];
				$wickets = $bowlingValue['wicketstaken'] + $value['wickets_taken'];
				$overs_bowled = $bowlingValue['oversbowled'] + $value['overs_bowled'];

				$bowls = $value['overs_bowled'] * 6;
				$averages = $wickets >0 ? $runs/$wickets : 0;
				$economy = $overs_bowled >0 ? $runs/$overs_bowled : 0;

				$updated = true;
				$bowling['player_id'] = $value['player_id'];
				$bowling['match_id'] = $matchID;
				$bowling['player_name'] = $value['player_name'];
				$bowling['matches'] = $bowlingValue['matches'] + 1;
				$bowling['oversbowled'] = $overs_bowled;
				$bowling['bowls'] =  $bowlingValue['bowls']  +  $bowls;
				$bowling['runsgiven'] = $bowlingValue['runsgiven'] + $value['runs_given'];
				$bowling['wicketstaken'] = $wickets;
				$bowling['economy'] = round($economy,2);
				$bowling['average'] = round($averages,2);
				$bowling['performancewickets5'] = $value['wickets_taken'];
				$bowling['performancewickets4'] = $bowlingValue['performancewickets5'];
				$bowling['performancewickets3'] = $bowlingValue['performancewickets4'];
				$bowling['performancewickets2'] = $bowlingValue['performancewickets3'];
				$bowling['performancewickets1'] = $bowlingValue['performancewickets2'];

				$this->db->where("player_id = " . $value['player_id']);
				$this->db->update('bowlingreport', $bowling);
			}

			if (!$updated) {
				$bowls = $value['overs_bowled'] * 6;
				$averages = $value['wickets_taken'] >0 ? $value['runs_given']/$value['wickets_taken'] : 0;
				$economy = $value['overs_bowled'] > 0 ? $value['runs_given']/$value['overs_bowled'] : 0;

				$bowling['player_id'] = $value['player_id'];
				$bowling['match_id'] = $matchID;
				$bowling['player_name'] = $value['player_name'];
				$bowling['matches'] = 1;
				$bowling['oversbowled'] = $value['overs_bowled'];
				$bowling['bowls'] = $bowls;
				$bowling['runsgiven'] = $value['runs_given'];
				$bowling['wicketstaken'] = $value['wickets_taken'];
				$bowling['economy'] = round($economy,2);
				$bowling['average'] = round($averages,2);
				$bowling['performancewickets5'] = $value['wickets_taken'];

				$this->db->insert('bowlingreport', $bowling);
			}
		}


		$this->load->view('admin_leaderboard', $data);
	}


	public function exportdata()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		echo 'export data for machine learning';
	}

	//End Of admin methods

	public function club_admin()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$this->load->view('club_admin');
	}

	public function create_player()
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$clubs = $this->db->select("*")
			->from('clubs')
			->where("userid = $this->auth_user_id")
			->get()
			->result_array();

		$data['clubs'] = $clubs;
		$data['is_admin'] = $this->is_admin;
		$this->load->view('create_player', $data);
	}


	public function createplayerpost()
	{
		if ($this->input->post()) {
			if (!$this->ion_auth->logged_in()) {
				// Redirect users who are not logged in to the login page
				redirect('auth/login', 'refresh');
			}

			$userId = $this->ion_auth->get_user_id(); // Get the logged-in user's ID

			// Get form input data
			$name = $this->input->post('name');
			$club_id = $this->input->post('club_id');
			$dob = $this->input->post('dob');
			$battingStyle = $this->input->post('battingStyle');
			$bowlingStyle = $this->input->post('bowlingStyle');
			$lastUpdated = date('Y-m-d H:i:s'); // Get the current date/time

			// Insert data into 'players' table
			$data = array(
				'club_id' => $club_id,
				'name' => $name,
				'dob' => $dob,
				'batting_style' => $battingStyle,
				'bowling_style' => $bowlingStyle,
				'userid' => $userId,
				'lastupdated' => $lastUpdated
			);

			// Assuming 'players' is the table name, adjust as per your database schema
			$this->db->insert('players', $data);

			if ($this->db->affected_rows() > 0) {
				// Insertion successful
				// Redirect to a success page or perform any further actions
				redirect('Welcome/players', 'refresh');
			} else {
				// Insertion failed
				echo 'Failed to create the player';
			}
		} else {
			// Handle if the form is not submitted
			echo 'Form not submitted';
		}
	}


	public function players()
	{
		if (!$this->ion_auth->logged_in()) {
			// Redirect users who are not logged in to the login page
			redirect('auth/login', 'refresh');
		}

		//get club id
		$clubID = $this->getClubID();

		// Fetch players' data from the 'players' table
		$result = $this->db->select('player.name,player.dob,player.batting_style,player.bowling_style,club.clubname as club_name')
			->from('players as player')
			->join('clubs as club', 'player.club_id = club.id');

		if (!$this->is_admin) {
			$result = $result->where("club.id = $clubID");
		}

		$result = $result->get();

		$data['players'] = $result->result_array();
		$data['is_admin'] = $this->is_admin;
		$this->load->view('player_list', $data);
	}


	public function s1($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// Redirect users who are not logged in to the login page
			redirect('auth/login', 'refresh');
		}

		$match = $this->db->select('match.*, home_club.clubname as home_club_name, away_club.clubname as away_club_name ')
			->from('matches as match')
			->where("match.id = $id")
			->join('clubs as home_club', 'match.hometeam = home_club.id')
			->join('clubs as away_club', 'match.awayteam = away_club.id')
			->get();

		$match_id = null;
		foreach ($match->result_array() as $matchItem) {
			$homeTeamID = $matchItem['hometeam'];
			$awayTeamID = $matchItem['awayteam'];
			$match_id = $matchItem['id'];

			$data['home_club_name'] = $matchItem['home_club_name'];
			$data['home_club_id'] = $matchItem['hometeam'];
			$data['away_club_name'] = $matchItem['away_club_name'];
			$data['away_club_id'] = $matchItem['awayteam'];
		}

		// Get all players from the 'players' table
		$data['home_players'] = $this->db->select("*")
			->from("players")
			->where("club_id = $homeTeamID")
			->get()->result_array();

		$data['away_players'] = $this->db->select("*")
			->from("players")
			->where("club_id = $awayTeamID")
			->get()->result_array();

		// Get all clubs from the 'clubs' table
		$data['clubs'] = $this->db->get('clubs')->result_array();
		$data['is_admin'] = $this->is_admin;
		$data['match_id'] = $match_id;

		$this->load->view('s1', $data);
	}

	/**
	 * @return mixed|void
	 */
	public function getClubID()
	{
		$club = $this->db->select('*')
			->from('clubs')
			->where("userid = $this->auth_user_id")
			->get()
			->result_array();

		foreach ($club as $item) {
			return $item['id'];
		}
		return 0;
	}

	/**
	 * @return mixed|void
	 */
	public function getUserID($email)
	{
		$club = $this->db->select('*')
			->from('users')
			->where("email = '$email'")
			->get()
			->result_array();

		foreach ($club as $item) {
			return $item['id'];
		}
		return 1;
	}

	/**
	 * @param $id
	 * @param $club_name
	 * @param $form_url
	 * @return void
	 */
	public function s2($id)
	{
		// Get all players from the 'players' table
		$data['players'] = $this->db->select("player.name,player.id as player_id,club.clubname as club_name")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->join('clubs as club', 'match_players.club_id = club.id')
			->where("toss_winner = '1' AND s1_id = $id")
			->get()->result_array();

		$data['s1_id'] = $id;
		$data['is_admin'] = $this->is_admin;

		foreach ($data['players'] as $value) {
			$data['club_name'] = $value['club_name'];
			break;
		}

		$this->load->view('s2', $data);
	}

	/**
	 * @param $id
	 * @return void
	 */
	public function s3($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['s1_id'] = $id;
		$data['is_admin'] = $this->is_admin;


		//-------------REDIRECT DUPLICATE TRANSACTIONS------------------
//		$s2 = $this->db->select("*")
//			->from("s2")
//			->where("completed = '0' AND s1_id = $id")
//			->get()->result_array();
//
//		foreach ($s2 as $item) {
//			$data['players'] = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
//				->from("match_players")
//				->join('players as player', 'match_players.player_id = player.id')
//				->join('clubs as club', 'match_players.club_id = club.id')
//				->where("toss_winner = '0' AND s1_id = $id")
//				->get()->result_array();
//
//			foreach ($data['players'] as $item) {
//				$data['club_name'] = $item['club_name'];
//				break;
//			}
//			$this->load->view('s3', $data);
//			return;
//		}
		//-------------END REDIRECT DUPLICATE TRANSACTIONS------------------


		$insert = [
			's1_id' => $id,
			'completed' => '0'
		];
		$this->db->insert('s2', $insert);

		$players = $this->db->select("player.name,player.id as player_id")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->where("toss_winner = '1'")
			->get()->result_array();

		foreach ($players as $value) {
			$player_id = $value['player_id'];

			$insert = [
				'batting' => $this->input->post("batting_$player_id"),
				'runs' => $this->input->post("runs_$player_id"),
				'balls_faced' => $this->input->post("balls_$player_id"),
				'in_out' => $this->input->post("out_not_out_$player_id"),
			];

			$this->db->where("s1_id = $id AND player_id = $player_id");
			$this->db->update('match_players', $insert);
		}

		// Get all players from the 'players' table
		$data['players'] = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->join('clubs as club', 'match_players.club_id = club.id')
			->where("toss_winner = '0' AND s1_id = $id")
			->get()->result_array();

		foreach ($data['players'] as $item) {
			$data['club_name'] = $item['club_name'];
			break;
		}
		$data['is_admin'] = $this->is_admin;
		$this->load->view('s3', $data);
	}


	/**
	 * @param $id
	 * @return void
	 */
	public function s4($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['s1_id'] = $id;
		$data['is_admin'] = $this->is_admin;

		//-------------REDIRECT DUPLICATE TRANSACTIONS------------------
//		$s3 = $this->db->select("*")
//			->from("s3")
//			->where("completed = '0' AND s1_id = $id")
//			->get()->result_array();
//
//		foreach ($s3 as $item) {
//			$data['players'] = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
//				->from("match_players")
//				->join('players as player', 'match_players.player_id = player.id')
//				->join('clubs as club', 'match_players.club_id = club.id')
//				->where("toss_winner = '0' AND s1_id = $id")
//				->get()->result_array();
//			foreach ($data['players'] as $item) {
//				$data['club_name'] = $item['club_name'];
//				break;
//			}
//			$this->load->view('s4', $data);
//			return;
//		}
		//-------------END REDIRECT DUPLICATE TRANSACTIONS------------------


		$insert = [
			's1_id' => $id,
			'completed' => '0'
		];
		$this->db->insert('s3', $insert);

		// Get all players from the 'players' table
		$players = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->join('clubs as club', 'match_players.club_id = club.id')
			->where("toss_winner = '0' AND s1_id = $id")
			->get()->result_array();

		foreach ($players as $value) {
			$player_id = $value['player_id'];
			$insert = [
				'bowled' => $this->input->post('bowled_' . $value['player_id']),
				'overs_bowled' => $this->input->post('overs_bowled_' . $value['player_id']),
				'runs_given' => $this->input->post('runs_given_' . $value['player_id']),
				'wickets_taken' => $this->input->post('wickets_taken_' . $value['player_id']),
				'economy' => $this->input->post('economy_' . $value['player_id'])
			];

			$this->db->where("s1_id = $id AND player_id = $player_id");
			$this->db->update('match_players', $insert);
		}

		$players = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->join('clubs as club', 'match_players.club_id = club.id')
			->where("toss_winner = '0' AND s1_id = $id")
			->get()->result_array();

		foreach ($players as $value) {
			$club_name = $value['club_name'];
			break;
		}

		$data['players'] = $players;
		$data['s1_id'] = $id;
		$data['club_name'] = $club_name;
		$this->load->view('s4', $data);
	}


	/**
	 * @param $id
	 * @return void
	 */
	public function s5($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		// Get all players from the 'players' table
		$players = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->join('clubs as club', 'match_players.club_id = club.id')
			->where("toss_winner = '0' AND s1_id = $id")
			->get()->result_array();

		foreach ($players as $value) {
			$player_id = $value['player_id'];

			$insert = [
				'batting' => $this->input->post("batting_$player_id"),
				'runs' => $this->input->post("runs_$player_id"),
				'balls_faced' => $this->input->post("balls_$player_id"),
				'in_out' => $this->input->post("out_not_out_$player_id"),
			];

			$this->db->where("s1_id = $id AND player_id = $player_id");
			$this->db->update('match_players', $insert);
		}

		$players = $this->db->select("player.name,player.id as player_id, club.clubname as club_name")
			->from("match_players")
			->join('players as player', 'match_players.player_id = player.id')
			->join('clubs as club', 'match_players.club_id = club.id')
			->where("toss_winner = '1' AND s1_id = $id")
			->get()->result_array();

		foreach ($players as $value) {
			$data['club_name'] = $value['club_name'];
			break;
		}
		$data['s1_id'] = $id;
		$data['is_admin'] = $this->is_admin;
		$data['players'] = $players;
		$this->load->view('s5', $data);
	}

	/**
	 * @param $id
	 * @return void
	 */
	public function batting_leaderboard($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['reports'] = $this->db->select("*")
			->from("battingleaderboard")
			->order_by("runs desc")
			->limit(10)
			->get()->result_array();

		$data['is_admin'] = $this->is_admin;
		$this->load->view('batting_leaderboard', $data);
	}

	public function bowling_leaderboard($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		$data['reports'] = $this->db->select("*")
			->from("bowlingreport")
			->order_by("bowls desc")
			->limit(10)
			->get()->result_array();
		$data['is_admin'] = $this->is_admin;
		$this->load->view('bowling_leaderboard', $data);
	}

	public function createclubpost()
	{
		if (!$this->ion_auth->logged_in()) {
			// Redirect users who are not logged in to the login page
			redirect('auth/login', 'refresh');
		}

		$clubName = $this->input->post('clubName');
		$email = $this->input->post('email');
		$homeGround = $this->input->post('homeGround');
		$userId = $this->getUserID($email);

		// Check if the club already exists
		$existingClub = $this->db->get_where('clubs', array('clubname' => $clubName))->row();

		if ($existingClub) {
			// Club with the given name already exists
			echo 'Club exists';
		} else {
			// Club doesn't exist, proceed to insert into the database
			$data = array(
				'clubname' => $clubName,
				'email' => $email,
				'homeground' => $homeGround,
				'userid' => $userId,
				'lastupdated' => date('Y-m-d H:i:s') // Assuming 'lastupdated' is a datetime field
			);

			// Insert the data into the 'clubs' table
			$this->db->insert('clubs', $data);


			// Replace with your SendGrid API key
			$apiKey = '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';

			// API endpoint for sending emails
			$sendGridApiUrl = 'https://api.sendgrid.com/v3/mail/send';

			// Sender details
			$fromEmail = 'info@suq.world';
			$fromName = 'Cricket System';

			// Recipient details
			$toEmail = $email;
			$toName = 'Mirav';

// Form validation passed, create user
			$password = 'clubpassword';

			$additional_data = array(
				'username' => $email, // You can customize this field as needed
			);

			$this->ion_auth->register($email, $password, $email, $additional_data);

			// Email subject
			$subject = 'Welcome To Your Club';

			// HTML content of the email
			$htmlContent = '<html><body><h5>You have successfully created a club. Kindly login with the password <b>' . $password . '</b> </h5></body></html>';


			// Prepare cURL request
			$headers = array(
				'Content-Type: application/json',
				'Authorization: Bearer ' . $apiKey
			);

			$data = array(
				'personalizations' => array(
					array(
						'to' => array(
							array(
								'email' => $toEmail,
								'name' => $toName
							)
						)
					)
				),
				'from' => array(
					'email' => $fromEmail,
					'name' => $fromName
				),
				'subject' => $subject,
				'content' => array(
					array(
						'type' => 'text/html',
						'value' => $htmlContent
					)
				)
			);

			$ch = curl_init($sendGridApiUrl);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			// Execute cURL request
			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			// Check if the email was sent successfully
			if ($httpCode == 202) {
				echo 'Email sent successfully!';
			} else {
				echo 'Failed to send email. HTTP Code: ' . $httpCode . ', Response: ' . $response;
			}

			// Close cURL session
			curl_close($ch);

			// Check if the insertion was successful
			if ($this->db->affected_rows() > 0) {
				echo 'Club inserted successfully';
				// Redirect to 'Welcome/admin' after successful insertion
				redirect('Welcome/admin', 'refresh');
			} else {
				echo 'Failed to insert club';
				// Redirect to 'Welcome/admin' after successful insertion
				redirect('Welcome/create_club', 'refresh');
			}
		}
	}

	/**
	 * @return void
	 */
	public function get_home_ground()
	{
		$home_team = $_GET['home_team'];
		$data = $this->db->select('clubs.homeground')
			->from('clubs')
			->where("id = $home_team")
			->get();
		$stadium = null;

		foreach ($data->result() as $result) {
			$stadium = $result->homeground;
		}

		echo json_encode([
			'home_ground' => $stadium
		]);
	}


	/**
	 * @return void
	 */
	public function process_s2()
	{
		$home_team = $this->input->post('home_team');
		$away_team = $this->input->post('away_team');
		$toss_winner = $this->input->post('toss_winner');
		$after_toss = $this->input->post('after_toss');
		$home_team_id = $this->input->post('home_team_id');
		$away_team_id = $this->input->post('away_team_id');
		$match_id = $this->input->post('match_id');

// dont update if existing
		$existing = $this->db->select('*')
			->from('s1')
			->where("toss_winner = $toss_winner AND after_toss = $after_toss AND completed = '0'")
			->get()->result_array();

		foreach ($existing as $data) {
			return $this->s2($data['id']);
		}

		$data = [
			'toss_winner' => $toss_winner,
			'after_toss' => $after_toss,
			'match_id' => $match_id
		];
		$this->db->insert('s1', $data);
		$s1_id = $this->db->insert_id();

		if ($after_toss != 1) {
			$toss_winner = $toss_winner == $home_team_id ? $away_team_id : $home_team_id;
		}

		//home team
		foreach ($home_team as $player) {
			$data = [
				'home_away' => 'home',
				'player_id' => $player,
				's1_id' => $s1_id,
				'toss_winner' => $toss_winner == $home_team_id,
				'club_id' => $home_team_id
			];
			$this->db->insert('match_players', $data);
		}


		//away team
		foreach ($away_team as $player) {
			$data = [
				'home_away' => 'away',
				'player_id' => $player,
				's1_id' => $s1_id,
				'toss_winner' => $toss_winner == $away_team_id,
				'club_id' => $away_team_id
			];
			$this->db->insert('match_players', $data);
		}

		return $this->s2($s1_id);
	}
}
