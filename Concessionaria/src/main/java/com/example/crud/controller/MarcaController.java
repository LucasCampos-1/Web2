package com.example.crud.controller;

import com.example.crud.model.Marca;
import com.example.crud.repository.MarcaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
@RequestMapping("/marcas")

public class MarcaController {
    
    @Autowired
    private MarcaRepository marcaRepository;

    @GetMapping
    public String listar(Model model) {
        model.addAttribute("marcas", marcaRepository.findAll());
        return "marcas/list";
    }

    @GetMapping("/nova")
    public String novaMarca(Model model){
        model.addAttribute("marca", new Marca());
        return "marcas/form";
    }

    @PostMapping("/salvar")
    public String salvar(@ModelAttribute Marca marca) {
        marcaRepository.save(marca);
        return "redirect:/";
    }

    @GetMapping("/editar/{id}")
    public String editar(@PathVariable long id, Model model) {
        model.addAttribute("marca", marcaRepository.findById(id).orElseThrow());
        return "marcas/form";
    }

    @GetMapping("/deletar/{id}")
    public String deletar(@PathVariable long id) {
        marcaRepository.deleteById(id);
        return "redirect:/";
    }
}
