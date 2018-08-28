<div class="footer_section">
    <div class="container">
        <div class="footer_top">
            <!-- <div class="footer_top_cont">
                <img src="{{ url('images/footer_icon1.png') }}" alt="">
                <p>Snailmail Address:<br>
                    Scheduleze ,PO Box 670382<br>
                    Chugiak, Alaska 99567
                </p>
            </div>
            <div class="footer_top_cont">
                <img src="{{ url('images/footer_icon1.png') }}" alt="">
                <p>Sometimes you just want a <br>'real' person::<br> 907.223.4958  </p>
            </div>
            <div class="footer_top_cont">
                <img src="{{ url('images/footer_icon1.png') }}" alt="">
                <p>Email:<br> General Email:<br> info@scheduleze.com </p>
            </div> -->
        </div>
        <div class="footer_bottom">
            <div class="col-sm-4">
                <h3>Contact <br> Scheduleze</h3>
                <p>Thanks for your interest in Scheduleze. Please contact us<br>
                    at one of these cell-phone free email addresses.
                </p>
            </div>
            <div class="col-sm-4">
                <div class="quick_links">
                    <h3>Quick <br> Links</h3>
                    <ul>
                        <li><a href="#">Scheduling Solutions</a></li>
                        <li><a href="#">Success  Stories</a></li>
                        <li><a href="#">Demo</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Client Login</a></li>
                    </ul>
                </div>
            </div>
            @guest
                <div class="col-sm-4" id="signup">
                    <h3>Try it now free for <br>30 days</h3>
                    @php $allindustries = getallIndustries() @endphp
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <select name="txtIndustries" required>
                            <option value="-1">Select Industrial</option>
                            @foreach($allindustries as $key => $industries)
                                <option  value="{{ $key }}">{{ $industries }}</option>
                            @endforeach
                        </select>
                        <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Business Email" required>
                        <!-- <input type="text" placeholder="Business Email"> -->
                        <input type="submit" value="TRY IT NOW" name="">
                    </form>
                </div>
            @endguest
        </div>
    </div>
    <div class="copyright_section">
        <div class="container">
            <div class="copright_left">&copy; copyright all rights reserved</div>
            <div class="copright_right">Client Login</div>
        </div>
    </div>
</div>