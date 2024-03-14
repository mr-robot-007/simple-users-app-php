
<div class="container w-[30%]  mx-auto mt-[10%] bg-gray-100 h-[100%]">

    <h1 class ="text-2xl font-bold px-4 py-2">Login</h1>
    
    <form method="POST" action = "dashboard.php" class="p-4 flex flex-col gap-4 font-semibold">
        <div class="form-group flex flex-col gap-2">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="outline rounded-md p-1 outline-2 b-2" name='email' aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group flex flex-col">
            <label for="exampleInputPassword1">Password</label>
    <input type="password" class="outline rounded-md p-1 outline-2 " name='password'  placeholder="Password">
</div>

<button type="submit" class=" bg-black text-white p-2 rounded-lg">Submit</button>
</form>
</div>