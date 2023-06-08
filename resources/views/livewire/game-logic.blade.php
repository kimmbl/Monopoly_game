<div>
    @if(!$lobby->is_started && (!$lobby->user2_id || $lobby->user1_id != Auth::id()))
        <div class="cell-info cell-roll">
            <p style="padding-top: 7vh">Очікування інших гравців</p><br>
        </div>
    @else
    <div class="cell-info cell-roll">
        <p style="padding-top: 2vh">Очікування інших гравців</p><br>
        <button class="btn btn-lg btn-success">Розпочати!</button>
    </div>
    @endif
</div>
