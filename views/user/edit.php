<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <style>
        body 
        {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 40px; /* Added padding on the right-hand side */
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .input-label {
            flex: 1;
            font-weight: bold;
            margin-right: 10px;
            color: #009688; /* Green color */
        }

        .input-field {
            flex: 3;
        }

        .input-field input[type="text"],
        .input-field input[type="email"],
        .input-field input[type="password"],
        .input-field select,
        .input-field textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .input-field input[type="checkbox"],
        .input-field input[type="radio"] {
            margin-right: 5px;
        }
    </style>
</head>
<style>
    .adbt{
        background-color: #009688;
    }
    .adbt:hover{
        background-color: #009688;
    }
</style>
<style>
    .btcl{
        background-color: darkgray;
    }
    .btcl:hover{
        background-color: darkgray;
    }
</style>
<body>
<script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <div class="container">
        <div class="header">
          Edit Form
        </div>
        <form action = "<?php echo base_url('form_new_entry'); ?>" method="post">
            <div class="input-group">
                <label class="input-label" for="name">Name:</label>
                <div class="input-field">
                    <input type="text" id="name" name="name" value="" required>
                </div>
            </div>
            <div class="input-group">
                <label class="input-label" for="message">Message:</label>
                <div class="input-field">
                    <textarea id="message" name="message" rows="4"></textarea>
                </div>
            </div>
            <div class="input-group">
                <label class="input-label">Gender:</label>
                <div class="input-field">
                    <input type="radio" id="male" name="gender" value="male">
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                </div>
            </div>
            <div class="input-group">
                <label class="input-label" for="email">Email:</label>
                <div class="input-field">
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="input-group">
                <label class="input-label" for="password">Password:</label>
                <div class="input-field">
                    <input type="password" id="password" name="password" required>
                </div>
            </div>
            <div class="input-group">
                <label class="input-label">Hobbies:</label>
                <div class="input-field">
                    <input type="checkbox" id="movie" name="hobbies" value="movie">
                    <label for="movie">Movie</label>
                    <input type="checkbox" id="travel" name="hobbies" value="travel">
                    <label for="travel">Travel</label>
                    <input type="checkbox" id="read" name="hobbies" value="read">
                    <label for="read">Read</label>
                    <input type="checkbox" id="foodie" name="hobbies" value="foodie">
                    <label for="foodie">Foodie</label>
                </div>
            </div>
            <div class="input-group">
                <label class="input-label" for="job">Job Profile:</label>
                <div class="input-field">
                    <select id="job" name="job_profile" >
                        <option value="developer">Developer</option>
                        <option value="writer">Writer</option>
                        <option value="seo">SEO</option>
                        <option value="media-buyer">Media Buyer</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <div class="input-label"></div>
                <div class="input-field">
                    <button type="submit" class="adbt btn btn-primary">Update</button>
                    <a href="<?php echo base_url('viewformusers')?>" class="btcl btn btn-primary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>