<style>
    .container-link{
        display : flex;
        flex-direction : column;
        justify-content : center;
        align-items : center;
        gap : 10px;
    }
    a{
        width : 10%;
    }
</style>

<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container-link">
                    <a href="/clients">Clients</a>
                    <a href="/rdv">Rendez vous</a>
                    <a href="/produits">Produits</a>
                    <a href="/factures">factures</a>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
