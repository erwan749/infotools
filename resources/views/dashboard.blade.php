<style>
    .container-link {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10%;
        padding: 20px;
    }

    .a_nav {
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 10px;
        color: white;
        font-size: 14px;
        width: 75%;
        text-align: center;
        background-color: #337ab7;
        border-color: #2e6da4 0.5px solid;
    }

    .a_nav:hover {
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 10px;
        color: white;
        font-size: 14px;
        text-align: center;
        background-color: #2e6da4;
        border-color: #2e6da4 0.5px solid;
    }

    @media (min-width: 768px) {
        .container-link {
            flex-direction: row;  
            flex-wrap: wrap;  
            justify-content: center; 
            gap: 20px;
        }

        .a_nav {
            width: 45%; 
        }
    }

    @media (max-width: 767px) {
        .container-link {
             height: 100%;
            flex-direction: column;
        }

        .a_nav {
            width: 75%;
        }
    }
</style>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container-link">
                    <a class="a_nav" href="/prospects">Prospects</a>
                    <a class="a_nav" href="/clients">Clients</a>
                    <a class="a_nav" href="/rdv">Rendez vous</a>
                    <a class="a_nav" href="/produits">Produits</a>
                    <a class="a_nav" href="/factures">Factures</a>
                    @if(auth()->user()->role == 'manager')
                        <a class="a_nav" href="/commercial">Commercial</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
