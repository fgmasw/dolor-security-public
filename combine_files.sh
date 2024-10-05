#!/bin/bash

# Nombre del archivo de salida
output_file="combined_files.txt"

# Elimina el archivo de salida si ya existe
if [ -f "$output_file" ]; then
  rm "$output_file"
fi

# Crea un nuevo archivo de salida
touch "$output_file"

# Escribe un mensaje amistoso al inicio del archivo de salida
echo "¡Hola! Voy a entregarte varios archivos con el código de mi aplicación web." >> "$output_file"
echo -e "\n" >> "$output_file"

# Encuentra todos los directorios en el directorio actual (nivel 1)
directories=$(find . -mindepth 1 -maxdepth 1 -type d)

# Listas para almacenar las rutas de los archivos entregados y sin código
copied_files=()
empty_files=()

# Procesa cada directorio
for dir in $directories; do
  # Pregunta al usuario si desea copiar los archivos del directorio
  read -p "¿Desea copiar los archivos del directorio $dir? (sí/no): " response

  # Convierte la respuesta a minúsculas
  response=$(echo "$response" | tr '[:upper:]' '[:lower:]')

  if [ "$response" == "sí" ] || [ "$response" == "si" ]; then
    echo "Código para los archivos en el directorio $dir y sus subdirectorios:" >> "$output_file"

    # Encuentra todos los archivos en el directorio actual y sus subdirectorios
    while IFS= read -r file; do
      echo "---------------------------" >> "$output_file"
      echo "* Código para $file:" >> "$output_file"
      
      # Verifica si el archivo está vacío
      if [ ! -s "$file" ]; then
        echo "El archivo está vacío porque no tiene código" >> "$output_file"
        # Agrega la ruta relativa del archivo a la lista de archivos sin código
        empty_files+=("${file#./}")
      else
        cat "$file" >> "$output_file"
        # Agrega la ruta relativa del archivo a la lista de archivos entregados
        copied_files+=("${file#./}") # Elimina el prefijo "./" para obtener la ruta relativa
      fi

      echo -e "\n\n" >> "$output_file"
    done < <(find "$dir" -type f)
  else
    echo "Saltando el directorio $dir y todos sus subdirectorios..."
  fi
done

# Esta sección se ejecuta después del bucle principal

# Imprime la cantidad y las rutas relativas de todos los archivos entregados con código al final
num_files=${#copied_files[@]}
echo "Se entregaron $num_files archivos con código." >> "$output_file"

if [ "$num_files" -gt 0 ]; then
  echo "Las rutas de los archivos entregados son:" >> "$output_file"
  for file in "${copied_files[@]}"; do
    echo "$file" >> "$output_file"
  done
else
  echo "No se entregaron archivos con código." >> "$output_file"
fi

# Imprime la cantidad y las rutas relativas de todos los archivos sin código al final
num_empty_files=${#empty_files[@]}
echo -e "\nSe encontraron $num_empty_files archivos sin código." >> "$output_file"

if [ "$num_empty_files" -gt 0 ]; then
  echo "Las rutas de los archivos sin código son:" >> "$output_file"
  for file in "${empty_files[@]}"; do
    echo "$file" >> "$output_file"
  done
else
  echo "No se encontraron archivos sin código." >> "$output_file"
fi
