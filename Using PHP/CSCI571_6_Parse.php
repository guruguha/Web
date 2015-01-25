<html>
    <head>
        <style>    
            .street {
                width: 200px;
                height: 25px;
            }
            
            .city {
                margin-left:66px;
                margin-top: 3px;
                width: 200px;
                height: 25px;
            }
            
            .states {
                margin-left:62px;
                margin-top: 3px;
                width: 60px;
                height: 25px;
            } 
            
            .btnSubmit {
                margin-left:110px; 
                margin-top:7px;
                border-radius: 2px;
                border: 1px solid black;
                width: 60px;
                height: 25px;
                display: inline-block;
            }
            
            .logo {
                margin-top: 7px;
                position:absolute;
            }
            
            .details {
                background-color:#F1EAC2;
                border:1px solid black;
                border-radius:3px;
                height:20px;
                margin-left:auto;
                margin-right:auto;
                position:relative;
                width:900px;
            }
            
            .tblProp {
                position:relative;
                margin-left:auto;
                margin-right:auto;
                width:900px;
            }
            
            fieldset {
                margin-left:auto;
                margin-right:auto;
                position:relative;
                width:32%;
                border:2px solid black;
                padding-top:13px;
            }
        </style>
    </head>
    <script>
        function verifyData() {            
            var streetVal = document.forms["myForm"]["stName"].value;
            var cityVal = document.forms["myForm"]["cityName"].value; 
            var stateVal = document.forms["myForm"]["stateName"].value; 
            
            if(streetVal == null || streetVal == "") {
                if(cityVal == null || cityVal == "") {
                    if(stateVal == null || stateVal == "choose") {
                            alert("Please enter the Street address, City and State");
                            return false;
                    } else {
                        alert("Please enter the Street address and City");
                        return false;
                    }
                } else if(stateVal == null || stateVal == "choose") {
                    alert("Please enter the Street address and State");
                    return false;
                } else {
                    alert("Please enter the Street address.");
                    return false;
                }
            } else if(cityVal == null || cityVal == "") {
                if(stateVal == null || stateVal == "choose") {
                    alert("Please enter the State and City");
                    return false;
                }
                else {
                    alert("Please enter the City");
                    return false;
                }
            } else if(stateVal == null || stateVal == "choose") {
                alert("Please enter the State");
                return false;
            } else {
                return true;
            }
        }
    </script>
    
    <body>
        <h2 style="text-align:center">Real Estate Search</h2>
        <fieldset class="divIn">
            <form action="" method="POST" name="myForm" onsubmit="return verifyData()">
                Street Address*: <input type="text" class="street" name="stName"/><br/>
                City*: <input type="text" class="city" name="cityName"/><br/>
                State*: <select class="states" name="stateName"><br/>
                            <option value="choose"></option>
                            <option value="AL">AL</option>
                            <option value="AK">AK</option>
                            <option value="AZ">AZ</option>
                            <option value="AR">AR</option>
                            <option value="CA">CA</option>
                            <option value="CO">CO</option>
                            <option value="CT">CT</option>
                            <option value="DE">DE</option>
                            <option value="DC">DC</option>
                            <option value="FL">FL</option>
                            <option value="GA">GA</option>
                            <option value="HI">HI</option>
                            <option value="IL">IL</option>
                            <option value="IN">IN</option>
                            <option value="IA">IA</option>
                            <option value="KS">KS</option>
                            <option value="KY">KY</option>
                            <option value="LA">LA</option>
                            <option value="ME">ME</option>
                            <option value="MD">MD</option>
                            <option value="MA">MA</option>
                            <option value="MI">MI</option>
                            <option value="MN">MN</option>
                            <option value="MS">MS</option>
                            <option value="MO">MO</option>
                            <option value="MT">MT</option>
                            <option value="NE">NE</option>
                            <option value="NV">NV</option>
                            <option value="NH">NH</option>
                            <option value="NJ">NJ</option>
                            <option value="NM">NM</option>
                            <option value="NY">NY</option>
                            <option value="NC">NC</option>
                            <option value="ND">ND</option>
                            <option value="OH">OH</option>
                            <option value="OK">OK</option>
                            <option value="OR">OR</option>
                            <option value="PA">PA</option>
                            <option value="RI">RI</option>
                            <option value="SC">SC</option>
                            <option value="SD">SD</option>
                            <option value="TN">TN</option>
                            <option value="TX">TX</option>
                            <option value="UT">UT</option>
                            <option value="VT">VT</option>
                            <option value="VA">VA</option>
                            <option value="WA">WA</option>
                            <option value="WV">WV</option>
                            <option value="WI">WI</option>
                            <option value="WY">WY</option>
                        </select></br>
                <input type="submit" class="btnSubmit" value="Search" name="submit"/>
                <a href="http://www.zillow.com" target="_blank"><img src="http://www.zillow.com/widgets/GetVersionedResource.htm?path=/static/logos/Zillowlogo_150x40_rounded.gif" width="150" height="40" alt="Zillow Real Estate Search" class="logo"/></a>
            </form>
        <p><i>* - Mandatory fields.</i></p>
        </fieldset>
    </body>
    
    <?php
        if(isset($_POST["submit"])): 
            error_reporting(E_ALL ^ E_NOTICE);

            $sendURL = "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=";
            $sendURL = $sendURL."X1-ZWz1b2xys103yj_7lwvq&";

            $streetName = $_POST['stName'];
            $cityName = $_POST['cityName'];
            $stateName = $_POST['stateName'];
            $city_state = $cityName.','.' '.$stateName;

            $searchStr = array('address' => $streetName,
                                'citystatezip' => $city_state
                              );    
            $sendURL = $sendURL.http_build_query($searchStr);
            $sendURL = $sendURL.'&rentzestimate=true';
            
            // Generate an XML
            $simpleXMLObj=simplexml_load_file($sendURL);
            if($simpleXMLObj->message->code != 0) {
                echo "<p align='center'>No exact match founnd for input address.</p>";
                echo "<p align='center'>&#169; Zillow, Inc., 2006-2014. Use is subject to <a href='http://www.zillow.com/corp/Terms.htm'>Terms of Use</a>";
                echo "<br/><a href='http://www.zillow.com/zestimate/'>What is Zestimate?</a></p>";
            } else {

                //Traverse up to the required child
                $homeDetails = $simpleXMLObj->response->results->result->links->homedetails;       //links tag

                //Extract address information
                $street = $simpleXMLObj->response->results->result->address->street;
                $city = $simpleXMLObj->response->results->result->address->city;
                $state = $simpleXMLObj->response->results->result->address->state;
                $zipcode = $simpleXMLObj->response->results->result->address->zipcode;

    //Full address
                $propertyAddr = $street.', '.$city.', '.$state.'-'.$zipcode;                                                             

    //Use code
                $useCode = $simpleXMLObj->response->results->result->useCode;           


    //Year built
                $yearBuilt = $simpleXMLObj->response->results->result->yearBuilt;                          


    //Tax Assess year
                $taxAssessmentYear = $simpleXMLObj->response->results->result->taxAssessmentYear;


    //Tax assessment
                $taxAssessment = $simpleXMLObj->response->results->result->taxAssessment;


    //Lot size
                $lotSize = $simpleXMLObj->response->results->result->lotSizeSqFt;


    //SQFT
                $finishedSqft = $simpleXMLObj->response->results->result->finishedSqFt;


    //Bathrooms
                $noOfBaths = $simpleXMLObj->response->results->result->bathrooms;


    //Bedrooms
                $noOfBedRooms = $simpleXMLObj->response->results->result->bedrooms;


    //Last sold date
                $lastSoldDate = $simpleXMLObj->response->results->result->lastSoldDate;


    //Last sold price
                $lastSoldPrice = $simpleXMLObj->response->results->result->lastSoldPrice;


    //Zestimate amount
                $zestAmount = $simpleXMLObj->response->results->result->zestimate->amount;


    //Last updated
                $lastUpdated = $simpleXMLObj->response->results->result->zestimate->last-updated;


    //Overall value change
                $overallChange = $simpleXMLObj->response->results->result->zestimate->valueChange;


    //Value range low
                $rangeLow = $simpleXMLObj->response->results->result->zestimate->valuationRange->low;


    //Value range high
                $rangeHigh = $simpleXMLObj->response->results->result->zestimate->valuationRange->high;


    //Rent zestimate amount
                $rentZestAmount = $simpleXMLObj->response->results->result->rentzestimate->amount;


    //Rent Zest Last updated
                $rentZestLastUpdated = $simpleXMLObj->response->results->result->rentzestimate->last-updated;


    //Rent zest value change
                $rentZestValChange = $simpleXMLObj->response->results->result->rentzestimate->valueChange;


    //Rent zest Value range low
                $rentZestRangeLow = $simpleXMLObj->response->results->result->rentzestimate->valuationRange->low;


    //Rent zest Value range high
                $rentZestRangeHigh = $simpleXMLObj->response->results->result->rentzestimate->valuationRange->high;

    //Write values back to HTML        
                echo "<h2 style='text-align:center'>Search Results</h2>";

                echo "<p class='details'>See more details for <a href=".$homeDetails." target='_blank'>".$propertyAddr."</a> on Zillow</p>";

                echo "<br/>";
                echo "<table class='tblProp'>";
                echo "<tr>";
                echo "<td>Property Type:</td>";
                echo "<td>".$useCode."</td>";
                echo "<td>Last Sold Price:</td>";
                echo "<td align='right'>$".number_format(floatval($lastSoldPrice),2)."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Year Built:</td>";
                echo "<td>".$yearBuilt."</td>";
                echo "<td>Last Sold Date:</td>";
                $lastSoldDate = date('d-M-Y', strtotime($lastSoldDate));
                echo "<td align='right'>".$lastSoldDate."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Lot Size:</td>";
                echo "<td>".$lotSize." sq.ft.</td>";
                $lastUpdated = date('d-M-Y', strtotime($lastUpdated));
                echo "<td>Zestimate &#174; Property Estimate as of " . $lastUpdated . ":</td>";
                echo "<td align='right'>$".number_format(floatval(abs($zestAmount)),2)."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Finished Area:</td>";
                echo "<td>".$finishedSqft." sq.ft.</td>";
                echo "<td>30 Days Overall Change ";
                if($overallChange < 0) {
                    echo "<img src='down_r.gif' alt='Down' width=8 height=15/>";
                    $overallChange = -$overallChange;
                    $overallChange = number_format(floatval($overallChange),2);            
                } else {
                    echo "<img src='up_g.gif' alt='Up' width=8 height=15/>";
                    $overallChange = number_format(floatval($overallChange),2);            
                }
                echo ":</td>";
                echo "<td align='right'>$".$overallChange."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Bathrooms:</td>";
                echo "<td>".$noOfBaths."</td>";
                echo "<td>All Time Property Change:</td>";
                echo "<td align='right'>$".number_format(floatval($rangeLow),2).'-$'.number_format(floatval($rangeHigh),2)."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Bedrooms:</td>";
                echo "<td>".$noOfBedRooms."</td>";
                $rentZestLastUpdated = date('d-M-Y', strtotime($rentZestLastUpdated));
                echo "<td>Rent Zestimate &#174; Valuation as of ".$rentZestLastUpdated.":  </td>";
                echo "<td align='right'>$".number_format(floatval(abs($rentZestAmount)),2)."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Tax Assessment Year:</td>";
                echo "<td>".$taxAssessmentYear."</td>";
                echo "<td>30 Days Rent Change ";
                if($rentZestValChange < 0) {
                    echo "<img src='down_r.gif' alt='Down' width=8 height=15/>";
                    $rentZestValChange = -$rentZestValChange;
                    $rentZestValChange = number_format(floatval($rentZestValChange),2);  
                } else {
                    echo "<img src='up_g.gif' alt='Up' width=8 height=15/>";
                    $rentZestValChange = number_format(floatval($rentZestValChange),2);  
                }
                echo ":</td>";
                echo "<td align='right'>$".number_format(floatval($rentZestValChange),2)."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Tax Assessment:</td>";
                echo "<td>$".number_format(floatval($taxAssessment),2)."</td>";
                echo "<td>All Time Rent Range:</td>";
                $rentRange = '$'.number_format(floatval($rentZestRangeLow),2).'-'.'$'.number_format(floatval($rentZestRangeHigh),2);
                echo "<td align='right'>".$rentRange."</td>";
                echo "</tr>";
                echo "</table><br/>";
                
                echo "<p align='center'>&#169; Zillow, Inc., 2006-2014. Use is subject to <a href='http://www.zillow.com/corp/Terms.htm'>Terms of Use</a>";
                echo "<br/><a href='http://www.zillow.com/zestimate/'>What is Zestimate?</a></p>";
                echo "</fieldset>";
            }
    endif;
    ?>
</html> 