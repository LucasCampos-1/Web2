package com.example.crud.model;

import jakarta.persistence.*;

@Entity
public class Marca {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nome;
    private String paisOrigem;

    public String getPaisOrigem() { 
        return paisOrigem; 
    }
    public void setPaisOrigem(String paisOrigem) { 
        this.paisOrigem = paisOrigem; 
    }

    public Marca() {}

    public Marca(String nome) {
        this.nome = nome;
    }

    public String getNome(){
        return nome;
    }

    public void setNome(String nome){
        this.nome = nome;
    }

    public Long getId() { 
        return id; 
    }
    
    public void setId(Long id) { 
        this.id = id; 
    }
}