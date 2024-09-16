{{ include('layouts/header.php', {title:'Edit User'})}}

<form method="post" action="{{ base }}/user/edit" class="form">

<section class="flex-center-center min-height70">
        <div class="structure flex gap20">
            <div class="profile-section">
                <div class="profile-image">
                    <img src="{{ asset }}img/profile/profile1.webp" alt="Profile Image of {{ user.name }}" id="profileImage">
                    <button class="btn btn-connection" id="changeImageBtn">Change the profile image</button>
                </div>
                
            </div>
            <div class="create-form-container">
                <div method="post" class="" >
            
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="{{ user.name }}" required>
                        {% if errors.name is defined %}
                            <span class="error">{{ errors.name }}</span>
                        {% endif %}
                    </div>
            
                    <div class="form-group">
                        <label for="surname">Surname:</label>
                        <input type="text" id="surname" name="surname" value="{{ user.surname }}" required>
                        {% if errors.name is defined %}
                            <span class="error">{{ errors.name }}</span>
                        {% endif %}
                    </div>
            
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="{{ user.username }}" required>
                        {% if errors.username is defined %}
                            <span class="error">{{ errors.username }}</span>
                        {% endif %}
                    </div>
            
                    <div class="form-group">
                        <label for="password">Password (Leave blank if not changing)</label>
                        <input type="password" name="password" id="password">
                        {% if errors.password is defined %}
                            <span class="error">{{ errors.password }}</span>
                        {% endif %}
                    </div>
            
                    <div class="reserve-submit">
                        <input type="submit" value="Update">
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>


{{ include('layouts/footer.php')}}