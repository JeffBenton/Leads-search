<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Lead extends CI_Model{
		function get_all(){
			return $this->db->query("SELECT * FROM leads")->result_array();;
		}

		function get_filtered_query($filters){
			if(empty($filters['name']) && empty($filters['from']) && empty($filters['to']))
				return "SELECT * FROM leads";
			$queryStr = 'SELECT * FROM leads WHERE';
			$queryArr = array();
			if(!empty($filters['name'])){
				$name = explode(' ', $filters['name']);
			}
			if(!isset($name) || count($name) > 2){
			}
			elseif(isset($name) && count($name) == 1){
				$queryStr .= " (first_name LIKE ? OR last_name LIKE ?)";
				$queryArr[] = $name[0] . '%';
				$queryArr[] = $name[0] . '%';
			}
			else{
				$queryStr .= " first_name LIKE ? AND last_name LIKE ?";
				$queryArr[] = $name[0] . '%';
				$queryArr[] = $name[1] . '%';
			}
			if(!empty($queryArr) && (!empty($filters['from']) || !empty($filters['to'])))
				$queryStr .= " AND";

			if($filters['from'] && !$filters['to']){
				$queryStr .= " registered_datetime >= ?";
				$queryArr[] = $filters['from'];
			}
			elseif(!$filters['from'] && $filters['to']){
				$queryStr.= "registered_datetime <= ?";
				$queryArr[] = $filters['to'];
			}
			elseif($filters['from'] && $filters['to']){
				$queryStr .= " registered_datetime BETWEEN ? AND ?";
				$queryArr[] = $filters['from'];
				$queryArr[] = $filters['to'];
			}
			return array($queryStr, $queryArr);
		}

		function get_filtered($filters){
			$query = $this->get_filtered_query($filters);
			if(count($query)<2)
				return $this->db->query($query)->result_array();
			return $this->db->query($query[0], $query[1])->result_array();
		}

		function get_limited($filters, $limit){
			$query = $this->get_filtered_query($filters);
			if(count($query) < 2){
				$query .= ' LIMIT ' . $limit[0] . ", " . $limit[1];
				return $this->db->query($query)->result_array();
			}
			$query[0] .= ' LIMIT ' . $limit[0] . ", " . $limit[1];
			return $this->db->query($query[0], $query[1])->result_array();
		}
	}
?>