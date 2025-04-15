<style>
    .container-link {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        padding: 40px 20px;
        background-color: #f4f6f8;
    }

    .card-link {
        display: flex;
        align-items: center;
        gap: 15px;
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: #fff;
        color: #333;
        border-radius: 12px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease-in-out;
    }

    .card-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        background-color: #e3f2fd;
    }

    .card-link .icon {
        color: #1976d2;
        min-width: 40px;
    }

    .card-link h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }

    .card-link p {
        margin: 4px 0 0 0;
        font-size: 14px;
        color: #666;
    }

    @media (max-width: 768px) {
        .card-link {
            flex-direction: row;
            align-items: center;
        }
    }

    @media (max-width: 480px) {
        .card-link {
            flex-direction: column;
            text-align: center;
        }

        .card-link .icon {
            margin-bottom: 10px;
        }
    }
</style>



<x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<div class="container-link">
    <a class="card-link" href="/prospects">
        <i class="fas fa-user-plus fa-2x icon"></i>
        <div>
            <h3>Gestion des prospects</h3>
            <p>Ajoutez, suivez vos prospects.</p>
        </div>
    </a>
    <a class="card-link" href="/clients">
        <i class="fas fa-users fa-2x icon"></i>
        <div>
            <h3>Gestion des clients</h3>
            <p>Visualisez et administrez votre base client.</p>
        </div>
    </a>
    <a class="card-link" href="/rdv">
        <i class="fas fa-calendar-check fa-2x icon"></i>
        <div>
            <h3>Gestion des rendez-vous</h3>
            <p>Organisez et planifiez vos rencontres commerciales.</p>
        </div>
    </a>
    <a class="card-link" href="/produits">
        <i class="fas fa-boxes fa-2x icon"></i>
        <div>
            <h3>Gestion des produits</h3>
            <p>Ajoutez, modifiez et gérez votre catalogue.</p>
        </div>
    </a>
    <a class="card-link" href="/factures">
        <i class="fas fa-file-invoice-dollar fa-2x icon"></i>
        <div>
            <h3>Gestion des factures</h3>
            <p>Générez, consultez et suivez vos factures clients.</p>
        </div>
    </a>
    @if(auth()->user()->role == 'manager')
    <a class="card-link" href="/commercial">
        <i class="fas fa-user-tie fa-2x icon"></i>
        <div>
            <h3>Gestion commerciale</h3>
            <p>Suivez votre équipe de commerciale.</p>
        </div>
    </a>
    @endif
</div>

</x-app-layout>
