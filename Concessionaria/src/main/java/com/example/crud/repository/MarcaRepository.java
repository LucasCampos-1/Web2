package com.example.crud.repository;

import com.example.crud.model.Marca;
import org.springframework.data.jpa.repository.JpaRepository;

public interface MarcaRepository extends JpaRepository<Marca, Long> {
    public Marca findByNome(String nome);
}
