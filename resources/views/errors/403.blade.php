<x-layout>
<div id="titlebar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h2>Error 403</h2>

                </div>
            </div>
        </div>
    </div>

    <div class="container text-center" style="min-height: 600px; display:flex; justify-content:center; align-items:center; flex-direction:column">
    <h1 style="font-size: 200px;">403</h1>    
    <h1>Looks like you are Unauthorized to view this page</h1>
        Error: {{$exception->getMessage()}}
        <a href="/">Return Home</a>
    </div>

</x-layout>