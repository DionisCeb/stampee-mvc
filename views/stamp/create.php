{{ include('layouts/header.php', {title:'Create your Stamp'})}}


<div class="create-form-container">
    <h1>Create New Stamp</h1>
    
    <form action="{{ base }}/stamp/create" method="post" class="create-stamp-form">
        <!-- Stamp Name -->
        <div class="form-group">
            <label for="stampName">Stamp Name</label>
            <input type="text" id="stampName" name="name" required>
        </div>

        <!-- Creation Date -->
        <div class="form-group">
            <label for="creationDate">Creation Date</label>
            <input type="date" id="creationDate" name="creation_date" required>
        </div>

        <!-- Colors -->
        <div class="form-group">
            <label for="colors">Colors</label>
            <input type="text" id="colors" name="color" placeholder="e.g., red, blue" required>
        </div>

        <!-- Country of Origin -->
        <div class="form-group">
            <label for="countryOfOrigin">Country of Origin</label>
            <input type="text" id="countryOfOrigin" name="country" required>
        </div>

        <!-- Condition -->
        <div class="form-group">
            <label for="condition">Condition</label>
            <select id="condition" name="stamp_condition" required>
                <option value="mint">Mint</option>
                <option value="used">Used</option>
            </select>
        </div>

        <!-- Print Run -->
        <div class="form-group">
            <label for="printRun">Print Run</label>
            <input type="number" id="printRun" name="print_run" required>
        </div>

        <!-- Dimensions -->
        <div class="form-group">
            <label for="dimensions">Dimensions (mm)</label>
            <input type="text" id="dimensions" name="dimensions" placeholder="Width x Height" required>
        </div>

        <!-- Certification -->
        <div class="form-group">
            <label for="certified">Certified</label>
            <select id="certified" name="certified" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <!-- Main Image URL -->
        <div class="form-group">
            <label for="mainImage">Main Image URL</label>
            <input type="text" id="mainImage" name="image_path[main]" placeholder="https://example.com/main-image.jpg" required>
        </div>

        <!-- Additional Image URLs -->
        <div class="form-group">
            <label for="additionalImage1">Additional Image URL 1</label>
            <input type="text" id="additionalImage1" name="image_path[additional][]" placeholder="https://example.com/additional-image1.jpg">
        </div>

        <div class="form-group">
            <label for="additionalImage2">Additional Image URL 2</label>
            <input type="text" id="additionalImage2" name="image_path[additional][]" placeholder="https://example.com/additional-image2.jpg">
        </div>

        <div class="form-group">
            <label for="additionalImage3">Additional Image URL 3</label>
            <input type="text" id="additionalImage3" name="image_path[additional][]" placeholder="https://example.com/additional-image3.jpg">
        </div>

        <!-- Submit Button -->
        <div class="reserve-submit">
            <input type="submit" value="Create Stamp">
        </div>
    </form>
</div>


<!---Footer-->
{{ include('layouts/footer.php')}}