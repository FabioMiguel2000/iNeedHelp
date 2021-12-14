
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iNeedHelp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
      #register-form{
        /* margin: 10% 25% 2em 25%; */
        padding: 2em;
        margin: auto;
        width: 50%;
        border: solid 1px grey;
        border-radius: 2em;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }
      #register-container{
        display: flex;
        flex-direction: row;

      }
    </style>
</head>
<body>
  <div id="register-container .bg-info.bg-gradient" >
    <div id="register-form">
      <form class="row g-3">
  
        <div class="col-12">
          <label for="exampleFormControlInput1" class="form-label">Username</label>
          <input type="text" class="form-control" placeholder="" aria-label="Last name">
        </div>
  
        <div class="col-6">
          <label for="exampleFormControlInput1" class="form-label">First Name</label>
          <input type="text" class="form-control" placeholder="John" aria-label="First name">
        </div>
  
        <div class="col-6">
          <label for="exampleFormControlInput1" class="form-label">Last Name</label>
          <input type="text" class="form-control" placeholder="Dean" aria-label="Last name">
        </div>
  
        <div class="col-12">
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="col-12">
          <label for="inputPassword4" class="form-label">Password</label>
          <input type="password" class="form-control" id="inputPassword4">
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label fw-lighter" style="font-size: 0.7em" for="gridCheck">
              Opt-in to receive occasional product updates, user research invitations, company announcements, and digests.
            </label>
          </div>
        </div>
        <div class="col-2 mx-auto">
          <button type="submit" class="btn btn-primary">Sign up</button>
        </div>
      </form>
    </div>
  </div>
  
    
</body>
</html>



