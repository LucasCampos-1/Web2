package com.example.crud.repository;

import com.example.crud.model.Veiculo;
import org.springframework.data.jpa.repository.JpaRepository;

public interface VeiculoRepository extends JpaRepository<Veiculo, Long> {
    public Veiculo findByModelo(String modelo);
}