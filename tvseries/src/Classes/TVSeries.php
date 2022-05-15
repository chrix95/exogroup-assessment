<?php

namespace Src\Classes;

class TVSeries {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function find($id)
    {
        $statement = "SELECT student_id, name, board FROM tvseries WHERE student_id = ?";

        try {
            $statement = $this->db->prepare($statement);
            $statement->bindValue(1, $id);
            $statement->execute();
            if ($response = $statement->fetch(\PDO::FETCH_ASSOC)) {
                // get the user grades
                $stm = $this->db->prepare("SELECT grade FROM grades WHERE user_id = ?");
                $stm->bindValue(1, $id);
                $stm->execute();
                $response['grades'] = $stm->fetchAll(\PDO::FETCH_ASSOC);
                $result = $this->checkResultStatus($response['board'], $response['grades']);
                // set the average and result status to the response
                $response['average'] = $result['average'];
                $response['final_result'] = $result['final_result'];
                if ($result['grades']) {
                    $response['grades'] = $result['grades'];
                }
                return $response;
            } else {
                return "User could not be found";
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function getAll ()
    {
        $statement = "SELECT tv_series.id, tv_series.title AS title, tv_series.channel AS channel, tv_series.gender AS gender, tv_series_intervals.week_day AS week_day, tv_series_intervals.show_time AS show_time FROM tv_series LEFT JOIN tv_series_intervals ON tv_series.id = tv_series_intervals.id_tv_series";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
            $response = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $response;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function getNextTVSeries ($query)
    {
        // $currentDayAndTime = $this->getCurrentWeekDayAndTime();
        $weekDay = isset($query['week_day']) ? $query['week_day'] : $this->getCurrentWeekDay();
        $showTime = isset($query['show_time']) ? $query['show_time'] : $this->getCurrentTime();

        $statement = "SELECT tv_series.id, tv_series.title AS title, tv_series.channel AS channel, tv_series.gender AS gender, tv_series_intervals.week_day AS week_day, tv_series_intervals.show_time AS show_time FROM tv_series LEFT JOIN tv_series_intervals ON tv_series.id = tv_series_intervals.id_tv_series WHERE tv_series_intervals.week_day = '$weekDay' AND tv_series_intervals.show_time > '$showTime' ORDER BY tv_series_intervals.show_time ASC LIMIT 1";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
            $response = $statement->fetch(\PDO::FETCH_ASSOC);
            unset($response['id']);
            return $response;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    private function getCurrentWeekDay()
    {
        return date('l');
    }

    private function getCurrentTime()
    {
        return date('H:i');
    }
}