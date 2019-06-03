<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            // $date = date( "d-m-Y","1548144077");
        //     $TimestampNow = new DateTime($date);
        //     $TimestampNow = $TimestampNow->getTimestamp();
        //     $TimestampNow->add(new DateInterval('P1M'));
        //     $tensDAy = $date->format('Y-m-d') . "\n";
           
       
        // echo $date."<br>";
        // echo $tensDAy."<br>";
        // echo "<br>".date( "d-m-Y", (int)$date." +2 month");

        // echo date( "Y-m-d", strtotime( "2009-01-31 +2 month" ) ); // PHP:  2009-03-31

        // $date = '2017-07-04';

// $dateAt = strtotime('+1 YEAR -1 DAY', strtotime($date));

// $newDate = date('d-m-Y', $dateAt);

// echo $newDate;



        // $happyday = "23.01.2019";
        // $curday = date('d.m.Y');
        // $d1 = strtotime($happyday);
        // $d2 = strtotime($curday);

        // $diff = $d1-$d2;
        // $diff = $diff/(60*60*24);
        // $years = floor($diff);

        // echo $years;
                
        return view('home');
    }
}
