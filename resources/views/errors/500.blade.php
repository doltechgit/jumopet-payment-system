
<div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>Error 500</h2>

                </div>
            </div>
        </div>
    </div>
    <div class="container text-center" style="min-height: 600px; display:flex; justify-content:center; align-items:center; flex-direction:column">
        <h1 style="font-size: 200px;">500</h1>
        <h1>Don't Worry, it's not you, it's us!</h1>
        Error: {{$exception->getMessage()}}
        <a href="mail:doltechgit@gmail.com">Contact Support</a>
    </div>

