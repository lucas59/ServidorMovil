<?php 
require_once 'contenido.php';
 class cine extends contenido
 {
 	
 	function __construct(argument)
 	{
 	@SerializedName("original_title")
    private String original_title;
    @SerializedName("backdrop_path")
    private String backdrop_path;
    @SerializedName("poster_path")
    private String poster_path;
    @SerializedName("results")
    private List<Peliculas> lista_elementos;
    @SerializedName("vote_average")
    private String nota;
    @SerializedName("overview")
    private String sinopsis;
    @SerializedName("release_date")
    private String fecha;
    @SerializedName("id")
    private String id;

    public String getSinopsis() {
        return sinopsis;
    }

    public String getFecha() {
        return fecha;
    }

    public String getNota() {
        return nota;
    }

    public List<Peliculas> getData(){
        return lista_elementos;
    }

    public Peliculas(String original_title, String nota, String poster_path, String id) {
        this.original_title = original_title;
        this.nota = nota;
        this.poster_path = poster_path;
        this.id = id;
    }

    public String getBackdrop_path() {

        return backdrop_path;
    }

    public String getOriginal_title() {

        return original_title;
    }

    public String getPoster_path() {

        return poster_path;
    }

    public String getId() {
        return id;
    }

 	}




 } ?>