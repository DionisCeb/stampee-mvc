{{ include('layouts/header.php', {title:'Edit your Stamp'})}}

<div class="create-form-container">
    <h1>Edit Stamp</h1>
    
    <form action="{{ base }}/stamp/edit" method="post" enctype="multipart/form-data">
        <!-- Hidden input to store the stamp ID -->
        <input type="hidden" name="id" value="{{ stamp.id }}">
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ stamp.name }}" required>
        </div>

        <div class="form-group">
            <label for="creation_date">Creation Date:</label>
            <input type="date" id="creation_date" name="creation_date" value="{{ stamp.creation_date }}" required>
        </div>

        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="{{ stamp.color }}" required>
        </div>

        <div class="form-group">
            <label for="country">Country of Origin:</label>
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
            <label for="print_run">Print Run:</label>
            <input type="text" id="print_run" name="print_run" value="{{ stamp.print_run }}" required>
        </div>

        <div class="form-group">
            <label for="dimensions">Dimensions:</label>
            <input type="text" id="dimensions" name="dimensions" value="{{ stamp.dimensions }}" required>
        </div>

        <div class="form-group">
            <label for="certified">Certified</label>
            <select id="certified" name="certified" required>
                <option value="yes" {% if stamp.certified == 'yes' %}selected{% endif %}>Yes</option>
                <option value="no" {% if stamp.certified == 'no' %}selected{% endif %}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="main_image">Main Image URL:</label>
            <input type="text" id="additionalImage1" name="image_path[additional][]" value="{{ additional_images[0] ?? '' }}">
        </div>

        <div class="form-group">
            <label for="additionalImage1">Additional Image URL 1:</label>
            <input type="text" id="additionalImage1" name="image_path[additional][]" value="{{ additional_images[0] ?? '' }}">
        </div>

        <div class="form-group">
            <label for="additionalImage2">Additional Image URL 2:</label>
            <input type="text" id="additionalImage2" name="image_path[additional][]" placeholder="https://example.com/additional-image2.jpg" value="{{ additional_images[1] ?? '' }}">
        </div>

        <div class="form-group">
            <label for="additionalImage3">Additional Image URL 3:</label>
            <input type="text" id="additionalImage3" name="image_path[additional][]" placeholder="https://example.com/additional-image3.jpg" value="{{ additional_images[2] ?? '' }}">
        </div>

        <div class="reserve-submit">
            <input type="submit" value="Update Stamp"></input>
        </div>
    </form>
</div>

<!---Footer-->
{{ include('layouts/footer.php')}}