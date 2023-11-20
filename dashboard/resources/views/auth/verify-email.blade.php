<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Voor je aan de slag kan moet je email adres geverifieerd worden. Dit doe je door op de link te klikken die zojuist naar het ingevulde mail adres gestuurd is. Als deze niet in de mailbox staat sturen we er graag nog een!') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Een nieuwe verificatie mail is zojuist gestuurd naar het ingevulde mail adres.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Verificatie mail opnieuw sturen') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Uitloggen') }}
            </button>
        </form>
    </div>
</x-guest-layout>