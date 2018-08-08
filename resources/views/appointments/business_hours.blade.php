@extends('layouts.front')

@section('content')
<table width="960" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td bgcolor="white">
                <div class="framecell">
                    <div class="frameadmin">
                        <form action="index.php" method="post">
                            <span class="head">Business hours for {{ Auth::user()->name }}</span>
                            <br> Please specify any business hours for
                            <select name="inspector" class="smallselect">
                                <option value="60" selected="">{{ Auth::user()->name }}</option>
                            </select>
                            <input type="submit" name="Submit" class="submit" value="Switch">
                            <input type="hidden" name="action" value="business_hours">
                        </form>
                        <form action="index.php" method="post">
                            Please select your normal working hours for each day
                            <br><span class="note">Specify reoccurring blockouts, like the second Tuesday of each month on your <a href="index.php?action=reoccurrence" class="note_link">Reoccurring Blockouts</a> page.</span>
                            <br>
                            <input type="hidden" name="trigger" value="1">
                            <input type="hidden" name="action" value="business_hours">
                            <br>
                            <table border="0" cellspacing="4" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><span class="formlabel">Open</span></td>
                                        <td><span class="formlabel">Close</span></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Sunday</td>
                                        <td>
                                            <select name="houropen[0]" class="smallselect">
                                                <option value="12" selected="">12</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_open[0]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amopen[0]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="hourclose[0]" class="smallselect">
                                                <option value="12" selected="">12</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_close[0]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amclose[0]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <input type="checkbox" name="closed[0]" value="1" checked=""><span class="note">closed all day</span></td>
                                    </tr>
                                    <tr>
                                        <td>Monday</td>
                                        <td>
                                            <select name="houropen[1]" class="smallselect">
                                                <option value="12" selected="">12</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_open[1]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amopen[1]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="hourclose[1]" class="smallselect">
                                                <option value="12" selected="">12</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_close[1]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amclose[1]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <input type="checkbox" name="closed[1]" value="1" checked=""><span class="note">closed all day</span></td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td>
                                            <select name="houropen[2]" class="smallselect">
                                                <option value="12" selected="">12</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_open[2]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amopen[2]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="hourclose[2]" class="smallselect">
                                                <option value="12" selected="">12</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_close[2]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amclose[2]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <input type="checkbox" name="closed[2]" value="1" checked=""><span class="note">closed all day</span></td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td>
                                            <select name="houropen[3]" class="smallselect">
                                                <option value="9" selected="">9</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_open[3]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amopen[3]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="hourclose[3]" class="smallselect">
                                                <option value="7" selected="">7</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_close[3]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amclose[3]" class="smallselect">
                                                <option value="PM" selected="">PM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <input type="checkbox" name="closed[3]" value="1"><span class="note">closed all day</span></td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td>
                                            <select name="houropen[4]" class="smallselect">
                                                <option value="9" selected="">9</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_open[4]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amopen[4]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="hourclose[4]" class="smallselect">
                                                <option value="1" selected="">1</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_close[4]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amclose[4]" class="smallselect">
                                                <option value="PM" selected="">PM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <input type="checkbox" name="closed[4]" value="1"><span class="note">closed all day</span></td>
                                    </tr>
                                    <tr>
                                        <td>Friday</td>
                                        <td>
                                            <select name="houropen[5]" class="smallselect">
                                                <option value="9" selected="">9</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_open[5]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amopen[5]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="hourclose[5]" class="smallselect">
                                                <option value="7" selected="">7</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_close[5]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amclose[5]" class="smallselect">
                                                <option value="PM" selected="">PM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <input type="checkbox" name="closed[5]" value="1"><span class="note">closed all day</span></td>
                                    </tr>
                                    <tr>
                                        <td>Saturday</td>
                                        <td>
                                            <select name="houropen[6]" class="smallselect">
                                                <option value="9" selected="">9</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_open[6]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amopen[6]" class="smallselect">
                                                <option value="AM" selected="">AM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="hourclose[6]" class="smallselect">
                                                <option value="5" selected="">5</option>
                                                <option value="12">12</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                            </select>
                                            <select name="minute_close[6]" class="smallselect">
                                                <option value="00" selected="">00</option>
                                                <option value="00">00</option>
                                                <option value="15">15</option>
                                                <option value="30">30</option>
                                                <option value="45">45</option>
                                            </select>
                                            <select name="amclose[6]" class="smallselect">
                                                <option value="PM" selected="">PM</option>
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                            <input type="checkbox" name="closed[6]" value="1"><span class="note">closed all day</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <input type="submit" class="submit" name="Submit" value="Update Business Hours">
                        </form>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="logo">
                    <a href="index.php"><img src="/images/scheduleze-logo.gif" alt="Take command of your day" width="244" height="79" border="0"></a>
                </div>
                <div class="frame-closing">
                    <br>
                    <br>
                    <br>
                    <span class="note">Customer Support: <a href="mailto:support@scheduleze.com">support@scheduleze.com</a></span></div>
            </td>
        </tr>
    </tbody>
</table>
@endsection