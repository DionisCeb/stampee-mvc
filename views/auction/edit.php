{{ include('layouts/header.php', {title:'Edit your Auction'})}}

<div class="create-form-container">
<h1>Modifier l'enchère</h1>
    <form method="POST" action="{{ base }}/auctioning/update">
        <input type="hidden" name="auction_id" value="{{ auction.id }}">
        
        <div class="form-group">
            <label for="start_date">Date de début</label>
            <input type="date" id="start_date" name="start_date" value="{{ auction.start_date }}" required>
        </div>
        
        <div class="form-group">
            <label for="end_date">Date de fin</label>
            <input type="date" id="end_date" name="end_date" value="{{ auction.end_date }}" required>
        </div>
        
        <div class="form-group">
            <label for="starting_price">Prix de départ</label>
            <input type="number" id="starting_price" name="starting_price" step="0.01" value="{{ auction.starting_price }}" required>
        </div>
        
        <div class="reserve-submit">
            <input type="submit" value="Mettre à jour l'enchère"></input>
        </div>
    </form>
</div>

<!---Footer-->
{{ include('layouts/footer.php')}}