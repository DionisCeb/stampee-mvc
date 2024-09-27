{{ include('layouts/header.php', {title:'Create your Auction'})}}



<div class="create-form-container">
    <h1>Créer une enchère pour ce timbre</h1>
    <form method="POST" action="{{ base }}/auctioning/store">
        <input type="hidden" name="stamp_id" value="{{ stamp.id }}">
        <div class="form-group">
            <label for="start_date">Date de début</label>
            <input type="date" id="start-date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Date de fin</label>
            <input type="date" id="end-date" name="end_date" required>
        </div>
        <div class="form-group">
            <label for="starting_price">Prix de départ</label>
            <input type="number" id="starting_price" name="starting_price" step="0.01" placeholder="Prix de départ" required>
        </div>
        <div class="reserve-submit">
            <input type="submit" value="Créer l'enchère"></input>
        </div>
    </form>
</div>




<!---Footer-->
{{ include('layouts/footer.php')}}