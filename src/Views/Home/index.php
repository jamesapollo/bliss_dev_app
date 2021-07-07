
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <nav class="navbar navbar-light bg-light">
     <span class="navbar-brand mb-0 h1">Bliss Health Care</span>
    </nav>
        <div class="container">
            
            <div class="row mt-4 d-flex justify-content-between align-items-center">
                <h1>List of Patients</h1>
                <button class="btn btn-outline-primary" onclick="openModal()">Add Patient</button>
            </div>
            <div class="row mt-4">
                <table class="table" id="listTb">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Type of Service</th>
                            <th scope="col">General Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach($patients as $key => $value ) {
                        ?>

                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value['patient_name'] ?></td>
                            <td><?= $value['date_of_birth'] ?></td>
                            <td><?= $value['gender'] ?></td>
                            <td><?= $value['service'] ?></td>
                            <td><?= $value['general_comment'] ?></td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="patientForm" method="POST" onsubmit="onFormSubmit(event)">
                        <div class="form-group">
                            <label>Patient Name</label>
                            <input type="text" class="form-control" id="patient_name" placeholder="Enter patient name">
                        </div>

                        <div class="form-group">
                            <label >Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" placeholder="Enter patient name">
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="fk_gender">
                                <?php foreach($genders as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>">
                                        <?= $value['gender'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="service">Service</label>
                            <select class="form-control" id="fk_service">
                                <?php foreach($services as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>">
                                        <?= $value['service_type'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="comment">General Comments</label>
                            <textarea class="form-control" id="general_comment" rows="3"></textarea>
                        </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   

    <script>

        function openModal(){
            console.log("Opening modal");
            $('.modal').modal()
        }

        function onFormSubmit(e) {
            e.preventDefault();

            var data = {
                "patient_name": $('#patient_name').val(),
                "date_of_birth": $('#date_of_birth').val(),
                "fk_gender": $('#fk_gender').val(),
                "fk_service": $('#fk_service').val(),
                "general_comment": $('#general_comment').val(),
            }           

            fetch('/patient/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data),
            }).then(function(data){
                return data.json();
            }).then(function(data){
                data = data['data'];
                $('.modal').modal('hide');
                var rows = document.getElementById('listTb').tBodies[0].children.length;
                rows = rows + 1;
                var table = document.getElementById('listTb');
                var row = table.insertRow(rows);

                var idCell = row.insertCell(0);
                var patientCell = row.insertCell(1);
                var dobCell = row.insertCell(2);
                var genderCell = row.insertCell(3);
                var serviceCell = row.insertCell(4);
                var commentCell = row.insertCell(5);

                idCell.innerHTML = rows;
                patientCell.innerHTML = data.patient_name;
                dobCell.innerHTML = data.date_of_birth;
                genderCell.innerHTML = data.gender;
                serviceCell.innerHTML = data.service;
                commentCell.innerHTML = data.general_comment;
            

            })
            .catch(function(data) {
                console.log(data);
            });            
        }
    </script>
  </body>
</html>