<div class="container  flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper rounded-lg">
            <div class="container">
                <img class="mx-auto h-10 w-auto rounded" src="https://imgs.search.brave.com/jWWBWk-2LbkG0G6U8cPjmeASIP1RFQIiHjKX28Rk704/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jdXRz/aG9ydC5pby9fbmV4/dC9pbWFnZT91cmw9/aHR0cHM6Ly9jZG52/Mi5jdXRzaG9ydC5p/by9jb21wYW55LXN0/YXRpYy81YzBhYTNh/YzBjN2Y2YTBlOTc4/Mjc3ZTQvdXNlcl91/cGxvYWRlZF9kYXRh/L2xvZ29zL2NvbXBh/bnlfbG9nb19MMUZo/WlhZQS5wbmcmdz0z/ODQwJnE9NzU" alt="Your Company">
                <h3 class="mt-4 text-center text-2xl/9 font-bold tracking-tight text-gray-900 pb-3">Login</h3>
                <hr class="pb-3">
                <?php if(session()->get('success')){?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success') ?>
                    </div>
                <?php }?>
                <form action="/login" method="post">
                    <div class="form-group">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <input type="text" class="form-control  w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="email" id="email" value="<?= set_value('email')?>">
                    </div>
                    <div class="form-group">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <input type="password" class="form-control  w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="password" id="password" value="">
                    </div>

                    <?php if (isset($validation)) { ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->listErrors(); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
                        </div>
                        <div class="col-12 col-sm-8 text-right">
                            <a href="/signup" class="font-semibold text-grey-600 hover:text-indigo-500">Don't have an account yet?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>