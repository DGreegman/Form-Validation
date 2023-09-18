<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
        theme: {
            extend: {
            colors: {
                clifford: '#da373d',
            }
            }
        }
        }
    </script>
    
</head>
<body>
    
    <header class="bg-black">
        <div class="container mx-auto  h-10 ">
            <p class="text-center text-white p-2">Simple Form Validation</p>
        </div>
    </header>
    <div class="container mx-56">
        <div class="w-1/2 py-12">

            <?php

                require_once __DIR__ . '/vendor/autoload.php';
                require_once __DIR__ . '/updated/CustomForm.php';
                require_once __DIR__ . '/updated/FileUpload.php';

                $myform = new CustomForm();
                $myform->validateForm();
            ?>

        <form method="POST" enctype="multipart/form-data">
                <?= csrf() ?>
                <div class="px-4 py-3 rounded relative <?= $myform->form->getClass() ?>">
                    <?=  $myform->form->getMessage() ?>
                </div>
            
                <div class="w-full py-5">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $myform->form->old('name') ?>"  class="p-2 w-full rounded-md  focus:outline-none border-2 border-slate-300"><br>
                </div>
                <div class="w-full py-5">
                    <label for="age">Age:</label>
                    <input type="number" class="p-2 w-full rounded-md  focus:outline-none border-2 border-slate-300" name="age" value="<?= $myform->form->old('age') ?>" >
                </div>

                <div class="w-full py-5">
                    <label for="avatar">Profile Avatar:</label>
                    <input type="file" name="avatar" accept="image/*" id="avatar"  >
                </div>

                <div class="w-full p-5">
                    <label for="Reading">
                        <input type="checkbox" name="activities[]" id="Reading" value="Reading" class="rounded text-pink-500" <?= $myform->checkbox('activities', 'Reading') ?> /> 
                        Reading
                    </label>
                    <br>
                    <label for="Writing">
                         <input type="checkbox" name="activities[]" id="Writing" value="Writing" class="rounded text-pink-500" <?= $myform->checkbox('activities', 'Writing') ?>/> Writing 
                    </label><br>
                    <label for="Running">
                        <input type="checkbox" name="activities[]" value="Running" id="Running" class="rounded text-pink-500" <?= $myform->checkbox('activities', 'Running') ?>/> Running 
                    </label><br>
                    <label for="Cooking">
                        <input type="checkbox" name="activities[]" id="Cooking" value="Cooking" class="rounded text-pink-500" <?= $myform->checkbox('activities', 'Cooking') ?>/> Cooking
                    </label><br>
                     
                </div>

                <div class="w-full py-5">
                    <input type="submit" value="Submit" class="bg-green-600 hover:bg-green-700 text-white text-center p-2 w-full rounded-md font-bold">
                </div>
            </form>    
        </div>
    </div>
</body>
</html>
