@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center my-4">
        <ul class="inline-flex items-center space-x-2">
            {{-- Botón de Página Anterior --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg">Anterior</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">Anterior</a>
                </li>
            @endif

            {{-- Números de Página --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li>
                        <span class="px-4 py-2 bg-blue-500 text-white rounded-lg">{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Botón de Página Siguiente --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">Siguiente</a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 bg-gray-300 text-gray-500 rounded-lg">Siguiente</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
