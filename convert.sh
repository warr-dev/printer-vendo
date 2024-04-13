#!/bin/bash 
infile=${1}

gs -q -o $(basename "${infile}")_p%04d.jpeg -sDEVICE=jpeg "${infile}"

# To get thumbnail JPEGs with a width 200 pixel use the following command:
# gs -q -o name_200px_p%04d.jpg -sDEVICE=jpeg -dPDFFitPage -g200x400 "${infile}"

# To get higher quality JPEGs (but also bigger-in-size ones) with a 
# resolution of 300 dpi use the following command:
# gs -q -o name_300dpi_p%04d.jpg -sDEVICE=jpeg -dJPEGQ=100 -r300 "${infile}"

echo "Done"