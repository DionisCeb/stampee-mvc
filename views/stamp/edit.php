{{ include('layouts/header.php', {title:'Edit your Stamp'})}}

<div class="create-form-container">
    <h1>Edit Stamp</h1>
    
    <form action="{{ base }}/stamp/edit" method="post" enctype="multipart/form-data">
        <!-- Hidden input to store the stamp ID -->
        <input type="hidden" name="id" value="{{ stamp.id }}">
        
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" value="{{ stamp.name }}" required>
        </div>

        <div class="form-group">
            <label for="creation_date">Date de création :</label>
            <input type="date" id="start-date" name="creation_date" value="{{ stamp.creation_date }}" required>
        </div>

        <div class="form-group">
            <label for="color">Couleur:</label>
            <input type="text" id="color" name="color" value="{{ stamp.color }}" required>
        </div>

        <div class="form-group">
            <label for="country">Pays d'origine :</label>
            <input type="text" id="country" name="country" value="{{ stamp.country }}" required>
        </div>

        <div class="form-group">
            <label for="stamp_condition">Condition:</label>
            <select id="stamp_condition" name="stamp_condition" required>
                <!-- <option value="Parfaite" {% if stamp.stamp_condition == 'Parfaite' %}selected{% endif %}>Parfaite</option> -->
                {% for condition in conditions %}
                    <option value="{{ condition }}" {% if stamp.stamp_condition == condition %}selected{% endif %}>{{ condition }}</option>
                {% endfor %}
            </select>
        </div>

        <div class="form-group">
            <label for="print_run">Tirage :</label>
            <input type="text" id="print_run" name="print_run" value="{{ stamp.print_run }}" required>
        </div>

        <div class="form-group">
            <label for="dimensions">Dimensions:</label>
            <input type="text" id="dimensions" name="dimensions" value="{{ stamp.dimensions }}" required>
        </div>

        <div class="form-group">
            <label for="certified">Certifié</label>
            <select id="certified" name="certified" required>
                <option value="yes" {% if stamp.certified == 'yes' %}selected{% endif %}>Oui</option>
                <option value="no" {% if stamp.certified == 'no' %}selected{% endif %}>Non</option>
            </select>
        </div>

        <div class="form-group">
            <label for="main_image">Image principale :</label>
            <input type="file" id="mainImage" name="image_path[main]" accept="image/*">
        </div>

        <div class="form-group">
            <label for="additionalImage1">Image supplémentaire 1:</label>
            <input type="file" id="additionalImage1" name="image_path[additional][]" accept="image/*">
        </div>

        <div class="form-group">
            <label for="additionalImage2">Image supplémentaire 2:</label>
            <input type="file" id="additionalImage2" name="image_path[additional][]" accept="image/*">
        </div>

        <div class="form-group">
            <label for="additionalImage3">Image supplémentaire 3:</label>
            <input type="file" id="additionalImage3" name="image_path[additional][]" accept="image/*">
        </div>

        <div class="reserve-submit">
            <input type="submit" value="Update Stamp"></input>
        </div>
    </form>
</div>

<!---Footer-->
{{ include('layouts/footer.php')}}