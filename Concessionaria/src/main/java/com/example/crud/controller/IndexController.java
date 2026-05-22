package com.example.crud.controller;

import com.example.crud.repository.MarcaRepository;
import com.example.crud.repository.VeiculoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class IndexController {

    @Autowired
    private MarcaRepository marcaRepository;

    @Autowired
    private VeiculoRepository veiculoRepository;

    @GetMapping("/")
    public String index(Model model) {
        model.addAttribute("marcas", marcaRepository.findAll());
        model.addAttribute("veiculos", veiculoRepository.findAll());
        return "index";
    }
}