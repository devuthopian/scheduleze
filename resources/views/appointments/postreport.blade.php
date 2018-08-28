@extends('layouts.front')

@section('content')
<div class="container">
    <div class="framecell">
        <div class="frameadmin">
            <div class="clearfix"></div>
            <div class="col-sm-12">
                <form enctype="multipart/form-data" action="{{ url('/scheduleze/save/report') }}" method="POST">
                    @csrf
                    <input type="hidden" name="booking" value="{{ $bookingid }}">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="bookclass table border table-responsive table-borderd table-striped select-default">
                        <tr>
                            <td class="display"></td>
                        </tr>
                        <tr>
                            <td>
                                <span class="head">
                                    Author: {{ $Report['firstname'] }} {{ $Report['lastname'] }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Recipients:<br>
                                <input type="text" name="email[]" value="{{ $Report['email'] }}" size="32"><br>
                                <input type="text" name="email[]" value="{{ $Report['agent_email'] }}" size="32"><br>
                                <input type="text" name="email[]" size="32"><br>
                                <input type="text" name="email[]" size="32"><br>
                                <input type="text" name="email[]" size="32" value="{{ $Report['inspector_email2'] }}"><br>
                                <span class="display">CC: {{ $Report['inspector_email'] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Select Document<br>
                                <input type="file" name="userfile" size="24"><br><span class="note">PDF, Word, Powerpoint, JPEG image only, 2.0 megs max</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Remove report from client view after:<br>
                                <select name="expire" size="1">
                                    <option value="3">3 days</option>
                                    <option value="5">5 days</option>
                                    <option value="7">7 days</option>
                                    <option value="10">10 days</option>
                                    <option selected value="14">14 days</option>
                                    <option value="21">21 days</option>
                                    <option value="30">30 days</option>
                                    <option value="60">60 days</option>
                                    <option value="90">90 days</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Summary (emailed to client):<br><textarea name="summary" rows="4" cols="60"></textarea></td>
                        </tr>
                        <tr>
                            <td>Memo (internal use only):<br><textarea name="memo" rows="4" cols="60"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="trigger" value="1"><input type="hidden" name="action" value="reports"><input type="submit" value="Post Report"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection