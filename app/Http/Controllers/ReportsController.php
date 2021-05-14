<?php

namespace App\Http\Controllers;
use App\Donation;
use App\Donor;
use Illuminate\Http\Request;
use App\Relief;
use App\Bought_item;
use App\Relief_Item;
use App\Expenditure;

class ReportsController extends Controller
{
    public function donationpdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_resident_data_to_html());
        return $pdf->stream();
    }
    
    public function convert_resident_data_to_html(){
        $donations = Donor::all();
        $output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            <title>PDF</title>
        </head>
        <body>
        <img src="img/brgylogo.jpg" height="80" width="80" style="float:left;">
        <div class="container-fluid" >
            <div class="d-flex justify-content-center">
                <h1>Donations Report</h1>
            </div>
            <div class="d-flex justify-content-center">
            <p>This are the donations received by the Barangay Lapasan</p>
            </div>
            <div class="row">
            <table class="table table-sm text-center">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>';
                foreach($donations as $donation){
                    $output .='
                    <tr>
                        <td>'.$donation->donor_name.'</td>
                        <td>'.$donation->donor_type.'</td>
                        <td>'.$donation->donor_contact_number.'</td>
                        <td>'.$donation->donor_email.'</td>
                        <td>';foreach($donation->mydonor as $item){
                            if($item->donation_type=="RELIEF"){
                                $output .='
                                <ul>
                                    <li>'.$item->donation_quantity.'&nbsp;'.$item->donation_unit.'&nbsp;'.$item->donation_description.'</li>
                                </ul>';
                            }else{
                                $output .='
                                <ul>
                                    <li>'.$item->donation_amount.'&nbsp;Pesos</li>
                                </ul>';
                            }
                           
                        }'</td>
                    </tr>';
                }
        $output .='</tbody>
            </table>
            </div>
        </div>
        </body>
        </html>';
        return $output;
    }


    public function reliefpdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_resident_data_to_html_relief());
        return $pdf->stream();
    }
    
    public function convert_resident_data_to_html_relief(){
        $reliefs = Relief::all();
        $output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            <title>PDF</title>
        </head>
        <body>
        <img src="img/brgylogo.jpg" height="80" width="80" style="float:left;">
        <div class="container-fluid" >
            <div class="d-flex justify-content-center">
                <h1>Distributed Relief Reports</h1>
            </div>
            <div class="d-flex justify-content-center">
            <p>This are the relief that are disseminated by the Barangay Lapasan</p>
            </div>
            <div class="row">
            <table class="table table-sm text-center">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Items</th>
                </tr>
            </thead>
            <tbody>';
                foreach($reliefs as $relief){
                    $output .='
                    <tr>
                        <td>'.$relief->relief_name.'</td>
                        <td>'.$relief->relief_quantity.'</td>
                        <td>'; foreach($relief->relief_items as $item){
                            $output .= '
                            <ul>
                                <li>'.$item->ri_quantity.'&nbsp;'.$item->ri_unit.'&nbsp;'.$item->ri_description.'</li>
                            </ul>';
                        }'</td>
                      
                    </tr>';
                }
        $output .='</tbody>
            </table>
            </div>
        </div>
        </body>
        </html>';
        return $output;
    }

    public function leftReliefpdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_resident_data_to_html_relief_left());
        return $pdf->stream();
    }
    
    public function convert_resident_data_to_html_relief_left(){
        $drice = Donation::where('donation_description','RICE')->sum('donation_quantity');
        $dcan = Donation::where('donation_description','CANNED GOODS')->sum('donation_quantity');
        $dnoodle = Donation::where('donation_description','NOODLE')->sum('donation_quantity');
        $dbw = Donation::where('donation_description','BOTTLED WATER')->sum('donation_quantity');
        $dcoffee = Donation::where('donation_description','COFFEE')->sum('donation_quantity');
        $dhk = Donation::where('donation_description','HYGIENE KITS')->sum('donation_quantity');
        $damount = Donation::where('donation_type','CASH')->sum('donation_amount');

        $erice = Bought_item::where('item_name','RICE')->sum('item_quantity');
        $ecan = Bought_item::where('item_name','CANNED GOODS')->sum('item_quantity');
        $enoodle = Bought_item::where('item_name','NOODLE')->sum('item_quantity');
        $ebw = Bought_item::where('item_name','BOTTLED WATER')->sum('item_quantity');
        $ecoffee = Bought_item::where('item_name','COFFEE')->sum('item_quantity');
        $ehk = Bought_item::where('item_name','HYGIENE KITS')->sum('item_quantity');
        $eamount  = Expenditure::sum('exp_used_amount');

        $rrice = Relief_Item::where('ri_description','RICE')->sum('ri_quantity');
        $rcan = Relief_Item::where('ri_description','CANNED GOODS')->sum('ri_quantity');
        $rnoodle = Relief_Item::where('ri_description','NOODLE')->sum('ri_quantity');
        $rbw = Relief_Item::where('ri_description','BOTTLED WATER')->sum('ri_quantity');
        $rcoffee = Relief_Item::where('ri_description','COFFEE')->sum('ri_quantity');
        $rhk = Relief_Item::where('ri_description','HYGIENE KITS')->sum('ri_quantity');

        $rice = $drice + $erice - $rrice;
        $noodle = $dnoodle + $enoodle - $rnoodle;
        $can = $dcan + $ecan - $rcan;
        $bw = $dbw + $ebw - $rbw;
        $coffee = $dcoffee + $ecoffee - $rcoffee;
        $hk = $dhk + $ehk - $rhk;


        $trice = $drice + $erice ;
        $tnoodle = $dnoodle + $enoodle ;
        $tcan = $dcan + $ecan;
        $tbw = $dbw + $ebw ;
        $tcoffee = $dcoffee + $ecoffee ;
        $thk = $dhk + $ehk;
        $amount = $damount - $eamount;

        $output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            <title>PDF</title>
        </head>
        <body>
        <img src="img/brgylogo.jpg" height="80" width="80" style="float:left;">
        <div class="container-fluid" >
            <div class="d-flex justify-content-center">
                <h1>Donations And Relief Reports</h1>
            </div>
            <div class="d-flex justify-content-center">
            <p>This are the record for the donations and relief that are received and distributed in the barangay</p>
            </div>
            <div class="row">
            <table class="table table-sm text-center">
            <thead>
                <tr>
                <th scope="col">Status</th>
                <th scope="col">Rice</th>
                <th scope="col">Noodles</th>
                <th scope="col">Canned Goods</th>
                <th scope="col">Bottled Water</th>
                <th scope="col">Coffee</th>
                <th scope="col">Hygiene Kit</th>
                <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Items</td>
                    <td>'.$trice.'</td>
                    <td>'.$tnoodle.'</td>
                    <td>'.$tcan.'</td>
                    <td>'.$tbw.'</td>
                    <td>'.$tcoffee.'</td>
                    <td>'.$thk.'</td>
                    <td>'.$damount.'</td>
                </tr>
                <tr>
                    <td>Total Used</td>
                    <td>'.$rrice.'</td>
                    <td>'.$rnoodle.'</td>
                    <td>'.$rcan.'</td>
                    <td>'.$rbw.'</td>
                    <td>'.$rcoffee.'</td>
                    <td>'.$rhk.'</td>
                    <td>'.$eamount.'</td>

                </tr>
                <tr>
                    <td>Total Left</td>
                    <td>'.$rice.'</td>
                    <td>'.$noodle.'</td>
                    <td>'.$can.'</td>
                    <td>'.$bw.'</td>
                    <td>'.$coffee.'</td>
                    <td>'.$hk.'</td>
                    <td>'.$amount.'</td>
                </tr>

                
            </tbody>
            </table>
            </div>
        </div>
        </body>
        </html>';
        return $output;
    }


}
