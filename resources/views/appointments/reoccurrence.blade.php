@extends('layouts.front')

@section('content')
<div class="container">
	<table width="960" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td bgcolor="white" valign="top">
                <div class="frameadmin">
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="reoccurrence">
                        <span class="head">Set Recurring Blockouts</span>
                        <br> Please specify any reoccurring time off for
                        <select name="inspector" class="smallselect">
                            <option value="60" selected="">Richard</option>
                        </select>
                        <input type="submit" name="Submit" class="submit" value="Switch">
                        <br><span class="note">(For example, Sundays, every week, or the second Tuesday of each month)</span>
                        <br>
                        <br>
                    </form>
                    <form action="index.php" method="post">
                        Day:
                        <select name="weekday[0reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[0]" class="smallselect">
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
                        <select name="minutestart[0]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[0]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[0]" class="smallselect">
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
                        <select name="minuteend[0]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[0]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[0][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[0][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[0][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[0][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[0][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[1reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[1]" class="smallselect">
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
                        <select name="minutestart[1]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[1]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[1]" class="smallselect">
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
                        <select name="minuteend[1]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[1]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[1][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[1][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[1][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[1][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[1][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[2reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[2]" class="smallselect">
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
                        <select name="minutestart[2]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[2]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[2]" class="smallselect">
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
                        <select name="minuteend[2]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[2]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[2][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[2][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[2][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[2][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[2][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[3reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[3]" class="smallselect">
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
                        <select name="minutestart[3]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[3]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[3]" class="smallselect">
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
                        <select name="minuteend[3]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[3]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[3][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[3][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[3][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[3][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[3][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[4reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[4]" class="smallselect">
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
                        <select name="minutestart[4]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[4]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[4]" class="smallselect">
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
                        <select name="minuteend[4]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[4]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[4][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[4][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[4][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[4][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[4][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[5reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[5]" class="smallselect">
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
                        <select name="minutestart[5]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[5]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[5]" class="smallselect">
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
                        <select name="minuteend[5]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[5]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[5][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[5][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[5][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[5][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[5][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[6reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[6]" class="smallselect">
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
                        <select name="minutestart[6]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[6]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[6]" class="smallselect">
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
                        <select name="minuteend[6]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[6]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[6][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[6][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[6][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[6][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[6][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[7reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[7]" class="smallselect">
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
                        <select name="minutestart[7]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[7]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[7]" class="smallselect">
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
                        <select name="minuteend[7]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[7]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[7][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[7][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[7][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[7][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[7][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[8reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[8]" class="smallselect">
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
                        <select name="minutestart[8]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[8]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[8]" class="smallselect">
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
                        <select name="minuteend[8]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[8]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[8][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[8][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[8][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[8][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[8][5]" checked="">5th&nbsp;week(s)<br><br></span> Day:
                        <select name="weekday[9reoc]" class="smallselect">
                            <option value="nothing" selected="">None</option>
                            <option value="0">Sunday</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                        </select>
                        Start
                        <select name="hourstart[9]" class="smallselect">
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
                        <select name="minutestart[9]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amstart[9]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        End
                        <select name="hourend[9]" class="smallselect">
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
                        <select name="minuteend[9]" class="smallselect">
                            <option value="00" selected="">00</option>
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select name="amend[9]" class="smallselect">
                            <option value="PM" selected="">PM</option>
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <span class="note">&nbsp;&nbsp;<input type="checkbox" name="weeks[9][1]" checked="">1st&nbsp;
                  <input type="checkbox" name="weeks[9][2]" checked="">2nd&nbsp;
                  <input type="checkbox" name="weeks[9][3]" checked="">3rd&nbsp;
                  <input type="checkbox" name="weeks[9][4]" checked="">4rd&nbsp;
                  <input type="checkbox" name="weeks[9][5]" checked="">5th&nbsp;week(s)<br><br></span>
                        <input type="hidden" name="reoccur" value="1">
                        <input type="hidden" name="inspector" value="60">
                        <input type="hidden" name="action" value="reoccurrence">
                        <input type="submit" name="Submit" class="submit" value="Set Time off for Richard »">
                    </form>
                    <br>
                    <span class="note"><a href="index.php" class="note_link">« Return to Admin Home</a></span>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span class="note">Customer Support: <a href="mailto:support@scheduleze.com">support@scheduleze.com</a>
               <a href="../index.php"><img src="../images/scheduleze-logo.gif" alt="Take command of your day" width="244" height="79" align="right" border="0" class="logo"></a>
               </span>
                </div>
            </td>
        </tr>
    </tbody>
</table>
</div>
@endsection