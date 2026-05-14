package com.example.crud.controller;

import com.example.crud.model.Marca;
import com.example.crud.model.Veiculo;
import com.example.crud.repository.MarcaRepository;
import com.example.crud.repository.VeiculoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
@RequestMapping("/veiculos")
public class VeiculoController {

    @Autowired
    private VeiculoRepository veiculoRepository;

    @Autowired
    private MarcaRepository marcaRepository;

    @GetMapping
    public String listar(Model model) {
        model.addAttribute("veiculos", veiculoRepository.findAll());
        return "veiculos/list";
    }

    @GetMapping("/novo")
    public String novoVeiculo(Model model) {
        model.addAttribute("veiculo", new Veiculo());
        model.addAttribute("marcas", marcaRepository.findAll());
        return "veiculos/form";
    }

    @PostMapping("/salvar")
    public String salvarVeiculo(@ModelAttribute Veiculo veiculo, @RequestParam Long marcaId) {
        Marca marca = marcaRepository.findById(marcaId).orElseThrow();
        veiculo.setMarca(marca);
        veiculoRepository.save(veiculo);
        return "redirect:/veiculos";
    }

    @GetMapping("/editar/{id}")
    public String editarVeiculos(@PathVariable Long id, Model model) {
        model.addAttribute("veiculo", veiculoRepository.findById(id).orElseThrow());
        model.addAttribute("marcas", marcaRepository.findAll());
        return "veiculos/form";
    }

    @GetMapping("/deletar/{id}")
    public String deletarVeiculo(@PathVariable Long id) {
        veiculoRepository.deleteById(id);
        return "redirect:/veiculos";
    }
}