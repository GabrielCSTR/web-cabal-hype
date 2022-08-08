<div class="widget-panel flex-s">
    <div class="widget-block">
        <div class="info-widget-block top-players flex-s">
            <h2 class="title-widget-block">Top Players</h2>
            <input type="button" class="add" value="">
        </div>
        <ul class="top-block top-players">
            <li class="top-title">
                <span class="top-number">#</span> <span class="top-flag"></span> <span class="top-name">Name</span> <span class="top-lvl">LvL</span> <span class="top-Res">Res<sup>REP</sup></span>
            </li>
            @foreach ($rankings as $key => $rank)
                <li class="top-list">
                    <span class="top-number">0{{ $key + 1 }}.</span> <span class="top-flag"><img src="images/flag-icon.png" alt=""></span> <span class="top-name"><a href="" title="nickname">{{ $rank->Name }}</a></span> <span class="top-lvl">{{ $rank->LEV }}</span> <span class="top-Res">
                    @php
                        if ($rank->Reputation<=10000) { echo '(0)';}
                        if ($rank->Reputation>=10000 and $rank->Reputation<20000) { echo '(1)';}
                        if ($rank->Reputation>=20000 and $rank->Reputation<40000) { echo '(2)';}
                        if ($rank->Reputation>=40000 and $rank->Reputation<80000) { echo ' (3)';}
                        if ($rank->Reputation>=80000 and $rank->Reputation<160000) { echo ' (4)';}
                        if ($rank->Reputation>=160000 and $rank->Reputation<320000) { echo ' (5)';}
                        if ($rank->Reputation>=320000 and $rank->Reputation<640000) { echo ' (6)';}
                        if ($rank->Reputation>=640000 and $rank->Reputation<1280000) { echo ' (7)';}
                        if ($rank->Reputation>=1280000 and $rank->Reputation<2560000) { echo ' (8)';}
                        if ($rank->Reputation>=2560000 and $rank->Reputation<5120000) { echo ' (9)';}
                        if ($rank->Reputation>=5120000 and $rank->Reputation<10000000) { echo ' (10)';}
                        if ($rank->Reputation>=10000000 and $rank->Reputation<20000000) { echo ' (11)';}
                        if ($rank->Reputation>=20000000 and $rank->Reputation<50000000) { echo ' (12)';}
                        if ($rank->Reputation>=50000000 and $rank->Reputation<80000000) { echo ' (13)';}
                        if ($rank->Reputation>=80000000 and $rank->Reputation<150000000) { echo ' (14)';}
                        if ($rank->Reputation>=150000000 and $rank->Reputation<300000000) { echo ' (15)';}
                        if ($rank->Reputation>=300000000 and $rank->Reputation<500000000) { echo ' (16)';}
                        if ($rank->Reputation>=500000000 and $rank->Reputation<1000000000) { echo ' (17)';}
                        if ($rank->Reputation>=1000000000 and $rank->Reputation<1500000000) { echo ' (18)';}
                        if ($rank->Reputation>=1500000000 and $rank->Reputation<2000000000) { echo ' (19)';}
                        if ($rank->Reputation>=2000000000) { echo ' (20)';}
                    @endphp
                    <sup>0</sup></span>
                </li>
            @endforeach
        </ul>
        {{-- <div class="x-buttons flex-c-c">
            <div class="list-buttons">
                <input type="button" value="x1000">
                <input type="button" value="x9999">
                <input type="button" value="x500">
            </div>
        </div> --}}
    </div>
    <div class="widget-block">
        <div class="info-widget-block top-guilds flex-s">
            <h2 class="title-widget-block">Top Guilds</h2>
            <input type="button" class="add">
        </div>
        <ul class="top-block top-guilds">
            <li class="top-title">
                <span class="top-number">#</span> <span class="top-flag"></span> <span class="top-name">Name</span> <span class="top-score">Score</span>
            </li>
            @foreach ($guilds as $key => $guild)
                <li class="top-list">
                    <span class="top-number">{{ $key +1 }}.</span> <span class="top-flag"><img src="images/flag-icon.png" alt=""></span> <span class="top-name"><a href="" title="nickname">{{ $guild->GuildName }}</a></span> <span class="top-score">{{ $guild->Point }}</span>
                </li>
            @endforeach
        </ul>
        {{-- <div class="x-buttons flex-c-c">
            <div class="list-buttons">
                <input type="button" value="x1000">
                <input type="button" value="x9999">
                <input type="button" value="x500">
            </div>
        </div> --}}
    </div>
    <div class="widget-block">
        <div class="info-widget-block top-event flex-s">
            <h2 class="title-widget-block">Event</h2>
            <input type="button" class="add">
        </div>
        <ul class="event-timers">
            {{-- <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li>
            <li>
                <p><span class="event-title">boldBlood</span><span class="time-start-event">12:00 AM</span></p>
                <p><span class="starts-in">Starts in</span><span class="time-to-event">0 hrs 20 min 20 sec</span></p>
            </li> --}}
        </ul>
    </div>
</div>
