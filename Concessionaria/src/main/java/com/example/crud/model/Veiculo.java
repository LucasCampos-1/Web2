package com.example.crud.model;

import jakarta.persistence.*;

@Entity
public class Veiculo {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne
    @JoinColumn(name = "marca_id")
    private Marca marca;

    private String modelo;
    private int ano;

    public Veiculo() {}

    public Veiculo(Marca marca, String modelo, int ano) {
        this.marca = marca;
        this.modelo = modelo;
        this.ano = ano;
    }

    public Long getId() { 
        return id; 
    }
    
    public void setId(Long id) { 
        this.id = id; 
    }

    public Marca getMarca() { 
        return marca; 
    }

    public void setMarca(Marca marca) { 
        this.marca = marca; 
    }

    public String getModelo() { 
        return modelo; 
    }

    public void setModelo(String modelo) { 
        this.modelo = modelo; 
    }

    public int getAno() { 
        return ano; 
    }
    
    public void setAno(int ano) { 
        this.ano = ano; 
    }
}