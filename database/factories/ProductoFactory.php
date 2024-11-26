<?php namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/** 
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto> 
 */
class ProductoFactory extends Factory 
{
    public function definition(): array 
    {
        $categoriasPapeleria = [
            'Cuadernos',
            'Lápices',
            'Bolígrafos',
            'Marcadores',
            'Libretas',
            'Carpetas',
            'Separadores',
            'Clips',
            'Gomas de borrar',
            'Reglas',
            'Correctores',
            'Papel bond',
            'Folders',
            'Cintas adhesivas',
            'Grapadoras'
        ];
        $precios = [
            'Cuadernos' => [50, 250],
            'Lápices' => [5, 40],
            'Bolígrafos' => [15, 80],
            'Marcadores' => [20, 150],
            'Libretas' => [40, 200],
            'Carpetas' => [30, 180],
            'Separadores' => [10, 50],
            'Clips' => [5, 30],
            'Gomas de borrar' => [5, 25],
            'Reglas' => [10, 60],
            'Correctores' => [15, 50],
            'Papel bond' => [80, 300],
            'Folders' => [10, 50],
            'Cintas adhesivas' => [10, 60],
            'Grapadoras' => [50, 250]
        ];

        $productos = [
            'Cuadernos' => [
                'Cuaderno profesional de 100 hojas',
                'Cuaderno espiral universitario',
                'Cuaderno de dibujo',
                'Libreta de notas ejecutiva',
                'Cuaderno rayado Norma'
            ],
            'Lápices' => [
                'Lápiz HB Faber Castell',
                'Lápiz de dibujo set 6B-2H',
                'Lápiz mecánico 0.5mm',
                'Lápices de colores Prismacolor',
                'Lápiz ergonómico'
            ],
            'Bolígrafos' => [
                'Bolígrafo Pilot punto fino',
                'Bolígrafo BIC negro',
                'Bolígrafo retráctil multicolor',
                'Bolígrafo gel',
                'Bolígrafo ejecutivo'
            ],
            'Marcadores' => [
                'Marcador permanente negro',
                'Set de marcadores fluorescentes',
                'Marcador para pizarra',
                'Marcador de texto',
                'Marcadores de colores'
            ],
            'Libretas' => [
                'Libreta de bolsillo',
                'Libreta con espiral',
                'Libreta de cuero',
                'Libreta de notas mini',
                'Libreta ejecutiva'
            ],
            'Carpetas' => [
                'Carpeta de argollas',
                'Carpeta de presentación',
                'Archivador de palanca',
                'Carpeta portafolio',
                'Carpeta organizadora'
            ],
            'Separadores' => [
                'Separadores de cartulina',
                'Separadores de plástico',
                'Separadores numerados',
                'Separadores de colores',
                'Separadores de archivo'
            ],
            'Clips' => [
                'Clips metálicos pequeños',
                'Clips de colores',
                'Clips grandes',
                'Clips de acero inoxidable',
                'Dispensador de clips'
            ],
            'Gomas de borrar' => [
                'Goma de borrar blanca',
                'Goma de borrar de migajón',
                'Goma de borrar para dibujo',
                'Goma de borrar de precisión',
                'Goma de borrar de colores'
            ],
            'Reglas' => [
                'Regla de plástico 30cm',
                'Regla metálica',
                'Regla transparente',
                'Regla graduada',
                'Regla flexible'
            ],
            'Correctores' => [
                'Corrector líquido',
                'Corrector en cinta',
                'Corrector en bolígrafo',
                'Corrector de precisión',
                'Corrector multiusos'
            ],
            'Papel bond' => [
                'Resma de papel bond carta',
                'Resma de papel bond oficio',
                'Papel bond premium',
                'Papel bond reciclado',
                'Papel bond de alta calidad'
            ],
            'Folders' => [
                'Folder de cartulina',
                'Folder de plástico',
                'Folder con fastener',
                'Folder de colores',
                'Folder tamaño carta'
            ],
            'Cintas adhesivas' => [
                'Cinta adhesiva transparente',
                'Cinta de papel',
                'Cinta de empaque',
                'Cinta doble cara',
                'Dispensador de cinta'
            ],
            'Grapadoras' => [
                'Grapadora pequeña',
                'Grapadora de escritorio',
                'Grapadora industrial',
                'Grapadora de pinza',
                'Mini grapadora'
            ]
        ];


        $descripciones = [
            'Cuadernos' => [
                'Diseñado para estudiantes y profesionales que buscan calidad y estilo.',
                'Ideal para tomar notas, dibujar o planificar tus proyectos.',
                'Cuaderno versátil con acabado premium y hojas de alta resistencia.',
                'Perfecto para la oficina, escuela o uso personal.',
                'Combina funcionalidad y elegancia en un solo producto.'
            ],
            'Lápices' => [
                'Trazo suave y preciso para dibujo y escritura.',
                'Fabricado con grafito de alta calidad para un rendimiento óptimo.',
                'Perfecto para estudiantes de arte y profesionales del dibujo.',
                'Diseñado para máxima comodidad y precisión.',
                'Excelente durabilidad y trazo consistente.'
            ],
            'Bolígrafos' => [
                'Escritura fluida y tinta de secado rápido.',
                'Diseño ergonómico para escritura cómoda.',
                'Ideal para uso diario en oficina o escuela.',
                'Tinta de alta calidad que no se difumina.',
                'Disponible en punta fina para escritura precisa.'
            ],
            'Marcadores' => [
                'Colores vibrantes y trazo uniforme.',
                'Perfecto para presentaciones, proyectos creativos y marcado.',
                'Tinta de secado rápido y sin manchas.',
                'Punta resistente para líneas precisas.',
                'Ideal para profesionales y estudiantes.'
            ],
            'Libretas' => [
                'Compacto y elegante, perfecto para llevar contigo.',
                'Diseño moderno con encuadernación de alta calidad.',
                'Ideal para apuntes rápidos, bocetos o planificación.',
                'Papel de primera calidad que previene el sangrado de tinta.',
                'Versatil y práctico para uso diario.'
            ],
            'Carpetas' => [
                'Organización profesional para tus documentos.',
                'Fabricado con materiales resistentes y duraderos.',
                'Diseño elegante y funcional para oficina o escuela.',
                'Múltiples compartimentos para máxima organización.',
                'Protege tus documentos con estilo.'
            ],
            'Separadores' => [
                'Organiza tus documentos con precisión y elegancia.',
                'Fácil de usar y de alta resistencia.',
                'Perfecto para archivos, cuadernos y carpetas.',
                'Colores claros para una identificación rápida.',
                'Diseñado para mantener tus documentos ordenados.'
            ],
            'Clips' => [
                'Sujeción firme y sin daños para tus documentos.',
                'Fabricados con metal de alta calidad.',
                'Disponibles en varios tamaños y colores.',
                'Resistentes a la deformación y corrosión.',
                'Ideal para oficina, escuela y uso personal.'
            ],
            'Gomas de borrar' => [
                'Borrado limpio sin dañar el papel.',
                'Elimina marcas sin dejar residuos.',
                'Perfecta para estudiantes y profesionales.',
                'Diseñada para no maltratar el papel.',
                'Máxima eficiencia en cada borrado.'
            ],
            'Reglas' => [
                'Mediciones precisas y líneas rectas perfectas.',
                'Fabricada con materiales de alta precisión.',
                'Ideal para dibujo técnico y diseño.',
                'Marcas claras y duraderas.',
                'Diseño ergonómico y resistente.'
            ],
            'Correctores' => [
                'Corrección limpia y precisa.',
                'Secado rápido sin grumos.',
                'Ideal para documentos importantes.',
                'Aplicación suave y uniforme.',
                'Diseñado para una corrección profesional.'
            ],
            'Papel bond' => [
                'Calidad premium para impresiones nítidas.',
                'Perfecto para documentos oficiales e impresiones.',
                'Alta blancura y opacidad.',
                'Compatible con impresoras láser e inkjet.',
                'Papel ecológico y de alta resistencia.'
            ],
            'Folders' => [
                'Organización profesional y elegante.',
                'Protección duradera para tus documentos.',
                'Disponible en diversos colores.',
                'Fabricado con materiales resistentes.',
                'Ideal para archivo y transporte de documentos.'
            ],
            'Cintas adhesivas' => [
                'Adhesión fuerte y limpia.',
                'Ideal para oficina, hogar y manualidades.',
                'Fácil de cortar y aplicar.',
                'No deja residuos.',
                'Diseño compacto y práctico.'
            ],
            'Grapadoras' => [
                'Grapado preciso y sin esfuerzo.',
                'Diseño ergonómico y resistente.',
                'Compatible con diversos tamaños de grapas.',
                'Ideal para oficina y uso escolar.',
                'Mecanismo suave y de fácil uso.'
            ]
        ];

        $categoria = fake()->randomElement($categoriasPapeleria);
        $nombre = fake()->randomElement($productos[$categoria]);
        $descripcion = fake()->randomElement($descripciones[$categoria]);

        return [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'categoria' => $categoria,
                'precio' => fake()->numberBetween($precios[$categoria][0], $precios[$categoria][1])        ];
    }
}